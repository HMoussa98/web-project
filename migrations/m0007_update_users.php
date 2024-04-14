<?php

namespace app\migrations;

use app\Database\Database;

class m0007_update_users
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function up()
    {
        $this->pdo->exec("CREATE TABLE users (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT,
            email TEXT,
            password TEXT
        );");

        echo "Applying up m0007__users\n";

    }

    public function down()
    {
        $this->pdo->exec("
            
        ");

        echo "Applying down m0007__users\n";
    }

}