<?php

require_once __DIR__.'/../vendor/autoload.php';


use app\controllers\CardController;
use app\controllers\HomeController;
use app\controllers\LoginController;
use app\core\Application;
use app\controllers\SiteController;
use app\controllers\AuthController;
use app\controllers\RegisterController;

// Get the instance of the Application class
$app = Application::getInstance(dirname(__DIR__));

// Define routes using the router instance of the Application
$app->router->get('/', [HomeController::class, 'index']);
$app->router->get('/contact', [SiteController::class, 'contact']);
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/addcard', [CardController::class, 'index']);
$app->router->post('/addcard', [CardController::class, 'addCard']);

$app->router->get('/login', [LoginController::class, 'login']);
$app->router->post('/login', [LoginController::class, 'login']);


$app->router->post('/register', [RegisterController::class, 'register']);
$app->router->get('/register', [RegisterController::class, 'register']);
$app->router->get('/register-success', [RegisterController::class, 'registerSuccess']);

// Run the application
$app->run();
