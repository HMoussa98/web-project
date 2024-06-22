<?php

namespace app\Database;

use PDO;
use PDOException;

class DatabaseConnector
{
    private $db;
    private static $instance = null;

    private function __construct($db_file)
    {
        try {
            $this->db = new PDO('sqlite:' . $db_file);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Successfully Connected to SQLite Database: $db_file";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public static function getInstance($db_file)
    {
        if (self::$instance == null) {
            self::$instance = new DatabaseConnector($db_file);
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->db;
    }

    public function executeQuery($query, $params = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }

    public function fetchQuery($query, $params = [])
    {
        try {
            $stmt = $this->db->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Query failed: " . $e->getMessage();
            return false;
        }
    }

    public function closeConnection()
    {
        $this->db = null;
        echo "Database connection closed.";
    }
}
