<?php
require_once '../vendor/autoload.php';

use app\Controller\DeckController;
use app\Http\Request;
use app\Http\Response;
use app\Middleware\Dispatcher;
use app\Middleware\RequestLogger;
use app\Routing\Router;
use app\Container\Container;
use app\View\Template;
use app\Model\Card;
use app\Model\UserModel;
use app\Model\DeckModel;

use app\Controller\UserController;
use app\Database\DatabaseConnector;

$dbFile = __DIR__ . '/../trading_card_game.db';
$db = DatabaseConnector::getInstance($dbFile)->getConnection();

$container = new Container();
$container->set('template', function () {
    return new Template('../templates');
});

$container->set('CardModel', function ($container) use ($db) {
    return new Card($db);
});

$container->set('UserModel', function ($container) use ($db) {
    return new UserModel($db);
});

$container->set('DeckModel', function ($container) use ($db) {
    return new DeckModel($db);
});

$container->set('HomeController', function ($container) {
    return new app\Controller\HomeController($container->get('template'));
});

$container->set('CardController', function ($container) {
    return new app\Controller\CardController($container->get('template'), $container->get('CardModel'));
});

$container->set('UserController', function ($container) {
    return new app\Controller\UserController($container->get('template'), $container->get('UserModel'));
});

$container->set('DeckController', function ($container) {
    return new DeckController($container->get('template'), $container->get('DeckModel'));
});

$dispatcher = new Dispatcher();
$dispatcher->add(new RequestLogger());

$router = new Router($container);

// Define routes
$router->addRoute('GET', '/', function () use ($container) {
    $controller = $container->get('CardController');
    return $controller->index();
});

$router->addRoute('GET', '/cards/create', function () use ($container) {
    $controller = $container->get('CardController');
    return $controller->showCreateForm();
});

$router->addRoute('POST', '/cards/create', function () use ($container) {
    $controller = $container->get('CardController');
    $request = Request::fromGlobals();
    return $controller->create($request);
});

$router->addRoute('GET', '/login', function () use ($container) {
    $controller = $container->get('UserController');
    return $controller->showLoginForm();
});

$router->addRoute('POST', '/login', function () use ($container) {
    $controller = $container->get('UserController');
    $request = Request::fromGlobals();
    return $controller->login($request);
});

$router->addRoute('GET', '/register', function () use ($container) {
    $controller = $container->get('UserController');
    return $controller->showRegisterForm();
});

$router->addRoute('POST', '/register', function () use ($container) {
    $controller = $container->get('UserController');
    $request = Request::fromGlobals();
    return $controller->register($request);
});

$router->addRoute('GET', '/card/edit/{id}', function ($id) use ($container) {
    $controller = $container->get('CardController');
    return $controller->edit(Request::fromGlobals(), $id);
});

$router->addRoute('GET', '/card/edit', function () use ($container) {
    $controller = $container->get('CardController');
    return $controller->edit2();
});

$router->addRoute('GET', '/decks', function () use ($container) {
    $controller = $container->get('DeckController');
    $request = Request::fromGlobals();
    return $controller->index($request);
});

$router->addRoute('GET', '/deck/make', function () use ($container) {
    $controller = $container->get('DeckController');
    return $controller->showForm();
});

$router->addRoute('POST', '/deck/make', function () use ($container) {
    $controller = $container->get('DeckController');
    $request = Request::fromGlobals();
    return $controller->make($request);
});

$router->addRoute('GET', '/deck/{id}', function ($id) use ($container) {
    $controller = $container->get('DeckController');
    $request = Request::fromGlobals();
    return $controller->show($request, $id);
});

$router->addRoute('POST', '/deck/delete/{id}', function ($id) use ($container) {
    $controller = $container->get('DeckController');
    $request = Request::fromGlobals();
    return $controller->delete($request, $id);
});

$router->addRoute('POST', '/card/update/{id}', function ($id) use ($container) {
    $controller = $container->get('CardController');
    return $controller->update(Request::fromGlobals(), $id);
});

$router->addRoute('POST', '/card/delete/{id}', function ($id) use ($container) {
    $controller = $container->get('CardController');
    return $controller->delete(Request::fromGlobals(), $id);
});

$router->addRoute('GET', '/users', function () use ($container) {
    $controller = $container->get('UserController');
    return $controller->index();
});

$router->addRoute('GET', '/users/show-edit', function () use ($container) {
    $controller = $container->get('UserController');
    return $controller->showForm();
});

$router->addRoute('POST', '/users/delete/{id}', function ($id) use ($container) {
    $controller = $container->get('UserController');
    $request = Request::fromGlobals();
    return $controller->deleteUser($request, $id);
});

// Dispatch request
$request = Request::fromGlobals();
$response = $dispatcher->dispatch($request, function ($request) use ($router) {
    return $router->dispatch($request);
});

// Output response
$response->send();

// HTML Navbar for navigation and user authentication
?>

<head>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding-top: 70px; /* Adjust body padding to accommodate fixed navbar */
        }
        .navbar {
            overflow: hidden;
            background-color: #333;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000; /* Ensure the navbar stays above other content */
        }
        .navbar a {
            float: left;
            display: block;
            color: white;
            text-align: center;
            padding: 14px 20px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar .right {
            float: right;
        }
        .navbar .login-btn, .navbar .register-btn {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .navbar .login-btn:hover, .navbar .register-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>

<div class="navbar">
    <a href="/">Home</a>
    <a href="/cards/create">Create Card</a>
    <a href="/decks">View Decks</a>
    <a href="/deck/make">Create Deck</a>
    <a href="/users">View Users</a>
    <div class="right">
        <a class="login-btn" href="/login">Login</a>
        <a class="register-btn" href="/register">Register</a>
    </div>
</div>

