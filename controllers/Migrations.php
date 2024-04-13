<?php

namespace app\controllers;

use app\Database\Database;

class Migrations
{
private $pdo;

public function __construct(Database $database)
{
$this->pdo = $database->connect();
}

public function runMigrations()
{
$migrationFiles = $this->getMigrationFiles();
    echo "migrationFiles";
    echo "<br>";
    echo "<br>";

var_dump($migrationFiles);
    echo "<br>";
    echo "<br>";

foreach ($migrationFiles as $migrationFile) {
$migrationName = $this->getMigrationName($migrationFile);
echo "migrationName inside foreach";
echo "<br>";
echo "<br>";
var_dump($migrationName);
if (!$this->migrationExists($migrationName)) {
    echo "migrationName  inside if";
    echo "<br>";
    var_dump($migrationName);
    echo "<br>";
    echo "<br>";


    echo "migrationFile inside if";
    echo "<br>";
    var_dump($migrationFile);
    echo "<br>";
    echo "<br>";
$this->applyMigration($migrationName, $migrationFile);
}
}

echo "Migrations completed\n";
}

public function getMigrationFiles()
{
return glob('migrations/*.php');
}

    public function getMigrationName($migrationFile)
    {
        return pathinfo($migrationFile, PATHINFO_FILENAME);
    }


    public function migrationExists($migrationName)
{
$stmt = $this->pdo->prepare("SELECT * FROM migrations WHERE migration = ?");
$stmt->execute([$migrationName]);
return (bool)$stmt->fetch();
}

    public function applyMigration($migrationName, $migrationFile)
    {
        require_once $migrationFile;

        // Remove the .php extension from the migration name
        $migrationName = pathinfo($migrationName, PATHINFO_FILENAME);
        $className = '\app\migrations\\' . $migrationName;

        $migrationClass = new $className($this->pdo);
        $migrationClass->up();
        $this->insertMigration($migrationName);
    }


    public function insertMigration($migrationName)
{
$stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (?)");
$stmt->execute([$migrationName]);
}

public function deleteMigration($migrationName)
{
$stmt = $this->pdo->prepare("DELETE FROM migrations WHERE migration = ?");
$stmt->execute([$migrationName]);
}

public function lastAppliedMigration()
{
$stmt = $this->pdo->query("SELECT migration FROM migrations ORDER BY id DESC LIMIT 1");
return $stmt->fetchColumn();
}

public function firstAppliedMigration()
{
$stmt = $this->pdo->query("SELECT migration FROM migrations ORDER BY id ASC LIMIT 1");
return $stmt->fetchColumn();
}
}
