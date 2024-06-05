<?php
namespace app\migrations;
use app\Database\Database;

class m0001_initial
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }


    public function up()
    {
        echo "Applying up\n";

        // Create the migrations table
        $this->pdo->exec("
        CREATE TABLE IF NOT EXISTS migrations (
            id INTEGER PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");

        // Insert the current migration into the migrations table
        $migrationName = basename(__FILE__, '.php');
        $stmt = $this->pdo->prepare("INSERT INTO migrations (migration) VALUES (?)");
        $stmt->execute([$migrationName]);
    }




    public function down()
    {
        echo "Applying down\n";

        // Drop the migrations table
        $this->pdo->exec("DROP TABLE IF EXISTS migrations");
    }
}
