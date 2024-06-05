<?php

namespace app\migrations;

use app\Database\Database;

class m0006_update_users
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function up()
    {
        $this->pdo->exec("DROP TABLE users");

        echo "Applying up m0006__users\n";

    }

    public function down()
    {
        $this->pdo->exec("
            
        ");

        echo "Applying down m0006__users\n";
    }

}