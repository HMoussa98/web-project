<?php
namespace app\Routing;

use app\Http\Request;
use app\Http\Response;

class Router {
    private $routes = [];

    public function addRoute($method, $uri, callable $handler) {
        $this->routes[] = compact('method', 'uri', 'handler');
    }

    public function dispatch(Request $request): Response {
        foreach ($this->routes as $route) {
            if ($request->getMethod() === $route['method'] && $request->getUri() === $route['uri']) {
                return call_user_func($route['handler'], $request);
            }
        }
        return new Response('Page Not Found', 404);
    }
}