<?php

namespace app\Database;
use PDO; // Importing PDO class from the global namespace

class Database
{
    private static $pdo;

    public static function connect()
    {
        if (!isset(self::$pdo)) {
            self::$pdo = new PDO('sqlite:./tradingCards.db');
            self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }


}