<?php

// Require Composer's autoloader
require __DIR__ . '/vendor/autoload.php'; // Navigate up one level to the vendor directory

use app\Http\Request;
use app\Http\Response;
use app\Middleware\LoggerMiddleware;
use app\Middleware\MiddlewareDispatcher;

// Create a sample request
$request = new Request('GET', '/example', ['Content-Type' => 'text/plain'], 'Sample request body');

// Create a response
$response = new Response();

// Create a middleware dispatcher
$dispatcher = new MiddlewareDispatcher();

// Add middleware(s) to the dispatcher
$dispatcher->addMiddleware(new LoggerMiddleware());

// Handle the request using the middleware dispatcher
$response = $dispatcher->handle($request, $response);

// Output the response
$response->send();
