<?php

namespace app\migrations;

use app\Database\Database;

class m0005_update_users
{

    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect();
    }

    public function up()
    {
        // Remove the default value constraint from the 'password' column in the 'users' table
        $this->pdo->exec("
            PRAGMA foreign_keys=off;
            BEGIN TRANSACTION;
            CREATE TEMPORARY TABLE users_backup(id, username, email, password);
            INSERT INTO users_backup SELECT id, username, email, password FROM users;
            DROP TABLE users;
            CREATE TABLE users(id, username, email, password);
            INSERT INTO users SELECT id, username, email, password FROM users_backup;
            DROP TABLE users_backup;
            COMMIT;
            PRAGMA foreign_keys=on;
        ");

        echo "Applying up m0005__users\n";

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