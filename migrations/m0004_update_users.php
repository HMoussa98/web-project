<?php

namespace app\migrations;

use app\Database\Database;

class m0004_update_users
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
        ADD COLUMN password VARCHAR(255) NOT NULL DEFAULT 'test123'
        ");

        echo "Applying up m0004__users\n";


    }

    public function down()
    {
        // Remove the 'password' column from the 'users' table
        $this->pdo->exec("
            ALTER TABLE users
            DROP COLUMN password
        ");

        echo "Applying down m0004__users\n";
    }

}