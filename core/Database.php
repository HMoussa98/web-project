<?php

class Database
{
    private static $pdo;

    public static function connect()
    {
        if (!isset(self::$pdo)) {
            self::$pdo = new PDO('sqlite:database.db');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
