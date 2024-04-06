<?php

// Require Composer's autoloader
require __DIR__ . '/vendor/autoload.php'; // Navigate up one level to the vendor directory

use app\Http\Request;
use app\Http\Response;
use app\Middleware\LoggerMiddleware;
use app\Middleware\MiddlewareDispatcher;

// Function to output a response
function outputResponse($response)
{
    // Output the response
    echo "Response Body: " . $response->getBody() . "\n";
    echo "Response Status Code: " . $response->getStatusCode() . "\n";
    echo "Response Headers: \n";
    foreach ($response->getHeaders() as $name => $value) {
        echo "$name: $value\n";
    }
}

// Test 1: Create a sample GET request
$request = new Request('GET', '/example', ['Content-Type' => 'text/plain'], 'Sample GET request body');

// Create a response
$response = new Response();

// Create a middleware dispatcher
$dispatcher = new MiddlewareDispatcher();

// Add middleware(s) to the dispatcher
$dispatcher->addMiddleware(new LoggerMiddleware());

// Handle the request using the middleware dispatcher
$response = $dispatcher->handle($request, $response);

// Output the response
echo "Test 1 (GET Request):\n";
outputResponse($response);
echo "\n";

// Test 2: Create a sample POST request
$request = new Request('POST', '/example', ['Content-Type' => 'application/json'], '{"key": "value"}');

// Reset response
$response = new Response();

// Handle the request using the middleware dispatcher
$response = $dispatcher->handle($request, $response);

// Output the response
echo "Test 2 (POST Request):\n";
outputResponse($response);
echo "\n";

// Test 3: Create a sample request with custom headers
$request = new Request('PUT', '/example', ['X-Custom-Header' => 'CustomValue'], 'Sample request body');

// Reset response
$response = new Response();
// Handle the request using the middleware dispatcher
$response = $dispatcher->handle($request, $response);

// Output the response
echo "Test 3 (Request with Custom Headers):\n";
outputResponse($response);
echo "\n";

// Add more tests as needed...

