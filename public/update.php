<?php

require_once '../vendor/autoload.php';

use app\repositories\UserRoleRepository;
use app\Database\Database;

// Connect to the database
$pdo = Database::connect();

// Instantiate UserRoleRepository

echo "User role updated successfully!\n";
