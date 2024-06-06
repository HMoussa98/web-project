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

// Middleware setup
$dispatcher = new Dispatcher();
$dispatcher->add(new RequestLogger());

// Router setup
$router = new Router($container);
$router->addRoute('GET', '/', function() use ($container) {
    $template = $container->get('template');
    return new Response($template->render('home'));
});

$router->addRoute('GET', '/card', function($id) use ($container) {
    $template = $container->get('template');
    return new Response($template->render('card'    ));
});


// Dispatch request through middleware
$request = Request::fromGlobals();
// $response = $dispatcher->dispatch($request, function($request) use ($router) {
//     return $router->dispatch($request);
// });

$response = new Response('Hello World', 200, ['Content-Type' => 'text/plain']);
echo "<pre>";
var_dump($response);
$response->send();
