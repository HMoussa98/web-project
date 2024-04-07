<?php

// Update the index.php file

// Require Composer's autoloader
require __DIR__ . '/vendor/autoload.php';

use app\Http\Request;
use app\Http\Response;
use app\Routing\Router;
use app\Routing\StaticRouting;
use app\Routing\ParameterizedRouting;
use app\Middleware\LoggerMiddleware;
use app\Middleware\MiddlewareDispatcher;
use app\Template\TwigTemplateEngine; // Import the TwigTemplateEngine
use app\Container\SimpleContainer; // Import the SimpleContainer

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

// Create a container
$container = new SimpleContainer();

// Register the template engine with the container
$container->set('template_engine', function () {
    return new TwigTemplateEngine();
});

// Define routes
$staticRoutes = [
    '/' => ['controller' => 'HomeController', 'action' => 'index'],
    '/about' => ['controller' => 'AboutController', 'action' => 'index'],
    '/contact' => ['controller' => 'ContactController', 'action' => 'index']
];

$parameterizedRoutes = [
    '/user/(\d+)' => ['controller' => 'UserController', 'action' => 'show']
];

// Create routing strategies
$staticStrategy = new StaticRouting($staticRoutes);
$parameterizedStrategy = new ParameterizedRouting($parameterizedRoutes);

// Create the router
$router = new Router($container); // Inject the container into the router

$router->addStrategy('static', $staticStrategy);
$router->addStrategy('parameterized', $parameterizedStrategy);

// Create a middleware dispatcher
$dispatcher = new MiddlewareDispatcher($container); // Inject the container into the middleware dispatcher

// Add middleware(s) to the dispatcher
$dispatcher->addMiddleware(new LoggerMiddleware());

// Define a function to handle the request
// Update the handleRequest function in index.php

// Define a function to handle the request
// Define a function to handle the request
function handleRequest($request, $router, $dispatcher)
{
    // Get the requested URL from the request
    $url = $request->getUri();

    // Match the route using the router
    $route = $router->matchRoute($url);

    // If a route is found, execute the corresponding controller action
    if ($route !== null) {
        $controllerName = $route['controller'];
        $actionName = $route['action'];

        // Check if the controller class exists
        if (class_exists($controllerName)) {
            // Instantiate the controller
            $controller = new $controllerName();

            // Check if the action method exists in the controller
            if (method_exists($controller, $actionName)) {
                // Execute the action method to get data
                $data = $controller->$actionName();

                // Render the template using the template engine
                $templateEngine = $GLOBALS['container']->get('template_engine');
                $templateContent = $templateEngine->render('index.html.twig', $data);

                // Create a response with the template content
                $response = new Response(200, ['Content-Type' => 'text/html'], $templateContent);

                // Output the response
                outputResponse($response);
            } else {
                // Action method not found in controller
                echo "Action method not found in controller: $actionName\n";
            }
        } else {
            // Controller class not found
            echo "Controller class not found: $controllerName\n";
        }
    } else {
        // If no route is found, handle the request with the middleware dispatcher
        $response = $dispatcher->handle($request, new Response());

        // Output the response
        echo "No matching route found for URL: $url\n";
        outputResponse($response);
    }
}



// Test 1: Create a sample GET request
$request1 = new Request('GET', '/', ['Content-Type' => 'text/plain'], 'Sample GET request body');
handleRequest($request1, $router, $dispatcher);
echo "\n";

// Test 2: Create a sample POST request
$request2 = new Request('POST', '/about', ['Content-Type' => 'application/json'], '{"key": "value"}');
handleRequest($request2, $router, $dispatcher);
echo "\n";

// Test 3: Create a sample request with custom headers
$request3 = new Request('PUT', '/contact', ['X-Custom-Header' => 'CustomValue'], 'Sample request body');
handleRequest($request3, $router, $dispatcher);
echo "\n";

// Add more tests as needed...

?>
