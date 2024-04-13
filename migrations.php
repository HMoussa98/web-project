<?php

require_once 'vendor/autoload.php';

use app\Database\Database;
use app\controllers\Migrations;

// Connect to the database
$database = new Database();
$migrations = new Migrations($database);

// Run migrations
$migrations->runMigrations();