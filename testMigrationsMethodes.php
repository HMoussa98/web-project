<?php
//maak eerstde functies public

require_once 'vendor/autoload.php';

use app\Database\Database;
use app\migrations\Migrations;

// Connect to the database
$db = new Database();

// Instantiate Migrations class
$migration = new Migrations($db);



echo "<br>";

$firstAppliedMigrations = $migration->firstAppliedMigration();
$lastAppliedMigration = $migration->lastAppliedMigration();

echo "first applied migrations $firstAppliedMigrations ";
echo "<br >";
echo "last  applied migrations $lastAppliedMigration ";
echo "<br >";
echo "<br >";


// Call the getMigrationName method from within the Migrations instance

echo "getMigrationName method from within the Migrations instance";
echo "<br>";

$migrationFile = 'migrations/m0001_initial.php';
$migrationName = $migration->getMigrationName($migrationFile);

// Assert that the migration name matches the expected value
var_dump(assert($migrationName === 'm0001_initial', "Failed to get migration name from file path."));
echo "<br>";


echo "Check if an existing migration exists or not ";
echo "<br>";


$existingMigration = 'm0001_initial';
$nonExistingMigration = 'm0002_create_users';

// Check if an existing migration exists
$existingResult = $migration->migrationExists($existingMigration);

// Check if a non-existing migration exists
$nonExistingResult = $migration->migrationExists($nonExistingMigration);

// Assert that the results are as expected
var_dump(assert($existingResult === true, "Failed to detect existing migration."));
var_dump(assert($nonExistingResult === false, "Failed to detect non-existing migration."));
echo "<br>";


echo "Insert a sample migration";
echo "<br>";
$migrationName2 = 'm0003_create_posts';
// Insert a sample migration
$migration->insertMigration($migrationName2);
$pdo2 = Database::connect();
// Query the migrations table to check if the migration was inserted
$stmt = $pdo2->prepare("SELECT * FROM migrations WHERE migration = ?");
$stmt->execute([$migrationName2]);
$migrationExists2 = (bool)$stmt->fetch();
// Assert that the migration was inserted
var_dump(assert($migrationExists2 === true, "Failed to insert migration into the database."));
echo "<br>";

echo "<br>";
echo "Delete migration";
echo "<br>";


// Delete the sample migration
$migration->deleteMigration($migrationName2);
// Query the migrations table to check if the migration was deleted
$stmt = $pdo2->prepare("SELECT * FROM migrations WHERE migration = ?");
$stmt->execute([$migrationName2]);
$migrationExists = (bool)$stmt->fetch();

// Assert that the migration was deleted
var_dump(assert($migrationExists === false, "Failed to delete migration from the database."));
