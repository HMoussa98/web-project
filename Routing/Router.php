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
        foreach ($this->routes as $route) {
            if ($request->getMethod() === $route['method'] && $request->getUri() === $route['uri']) {
                $response = call_user_func($route['handler'], $request);

                // Ensure the response is an instance of Response
                if (!$response instanceof Response) {
                    throw new \TypeError('Return value must be of type app\Http\Response');
                }

                return $response;
            }
        }
        return new Response('Page Not Found', 404);
    }
}
