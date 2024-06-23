<?php

namespace app\Routing;
use app\Http\Request;
use app\Http\Response;

class Router
{
    private $routes = [];

    public function addRoute($method, $uri, callable $handler)
    {
        $this->routes[] = compact('method', 'uri', 'handler');
    }

    public function dispatch(Request $request): Response
    {   
        $requestUri = $request->getUri();
        $requestMethod = $request->getMethod();

        foreach ($this->routes as $route) {
            $routeUri = $route['uri'];
            $routeMethod = $route['method'];
            $handler = $route['handler'];

            // Check if method matches
            if ($requestMethod !== $routeMethod) {
                continue;
            }

            // Check if the URI matches (considering dynamic segments)
            $regex = $this->convertUriToRegex($routeUri);
            if (preg_match($regex, $requestUri, $matches)) {
                array_shift($matches); // Remove full match
                array_unshift($matches, $request); // Add request object to the beginning
                $response = call_user_func_array($handler, $matches);

                // Ensure the response is an instance of Response
                if (!$response instanceof Response) {
                    throw new \TypeError('Return value must be of type app\Http\Response');
                }

                return $response;
            }
        }
        return new Response('Page Not Found', 404);
    }

    private function convertUriToRegex($uri)
    {
        // Convert URI with placeholders to a regex pattern
        return '@^' . preg_replace('/{([\w]+)}/', '([\w-]+)', $uri) . '$@';
    }
}
