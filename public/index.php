<?php
require_once '../vendor/autoload.php';

use app\Http\Request;
use app\Http\Response;
use app\Middleware\Dispatcher;
use app\Middleware\RequestLogger;
use app\Routing\Router;
use app\Container\Container;
use app\View\Template;

$container = new Container();
$container->set('template', function() {
    return new Template('../templates');
});

$container->set('HomeController', function($container) {
    return new app\Controller\HomeController($container->get('template'));
});

$container->set('CardController', function($container) {
    return new app\Controller\CardController($container->get('template'));
});

// Middleware setup
$dispatcher = new Dispatcher();
$dispatcher->add(new RequestLogger());

// Router setup
$router = new Router($container);
$router->addRoute('GET', '/', function() use ($container) {
    $controller = $container->get('HomeController');
    return $controller->index();
});

$router->addRoute('GET', '/card', function() use ($container) {
    $controller = $container->get('CardController');
    return $controller->show();
});


// Dispatch request through middleware
$request = Request::fromGlobals();
$response = $dispatcher->dispatch($request, function($request) use ($router) {
    return $router->dispatch($request);
});
$response->send();
