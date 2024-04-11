<?php

// index.php
// index.php

require_once 'vendor/autoload.php';

use app\Container\SimpleContainer;
use app\Routing\Router;
use app\Routing\ParameterizedRouting;
use app\Routing\StaticRouting;
use app\Middleware\MiddlewareDispatcher;
use app\Middleware\LoggerMiddleware;
use app\Template\Templating;
use app\Http\Request;
use app\Http\Response;

// Initialize container
$container = new SimpleContainer();

// Register services in the container
$container->set('templating', function () {
    return new Templating(__DIR__ . '/templates');
});

$container->set('router', function () {
    $router = new Router();
    $router->addStrategy('parameterized', new ParameterizedRouting([
        '/home' => ['controller' => 'app\Controllers\HomeController', 'action' => 'index'],
    ]));
    $router->addStrategy('static', new StaticRouting([
        '/about' => ['controller' => 'app\Controllers\AboutController', 'action' => 'index'],
    ]));
    return $router;
});

$container->set('middlewareDispatcher', function () {
    $middlewareDispatcher = new MiddlewareDispatcher();
    $middlewareDispatcher->addMiddleware(new LoggerMiddleware());
    return $middlewareDispatcher;
});

// Resolve dependencies from the container
$templating = $container->get('templating');
$router = $container->get('router');
$middlewareDispatcher = $container->get('middlewareDispatcher');

// Simulate incoming request
$request = new Request('GET', '/hello', [], '');

// Route the request
$route = $router->matchRoute($request->getUri());

if ($route) {
    // Call middleware stack
    $response = $middlewareDispatcher->handle($request, new Response());

    // Call controller action
    $controllerClass = $route['controller'];
    $action = $route['action'];
    $controller = new $controllerClass($templating);
    $response = $controller->$action($request, $response);

    // Send response
    $response->send();
} else {
    // Handle 404 Not Found
    echo "404 Not Found";
}


?>