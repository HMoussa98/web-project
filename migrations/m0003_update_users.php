<?php
namespace app\migrations;
use app\Database\Database;

class m0003_update_users
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function up()
    {
        // Add the 'password' column to the 'users' table
        $this->pdo->exec("
            ALTER TABLE users
            DROP COLUMN password
        ");

        echo "Applying up m0003__users\n";


    }

    public function down()
    {
        // Remove the 'password' column from the 'users' table
        $this->pdo->exec("
            ALTER TABLE users
            DROP COLUMN password
        ");

        echo "Applying down m0003__users\n";
    }
}
