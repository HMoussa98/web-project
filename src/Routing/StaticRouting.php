<?php

namespace app\Routing;

class StaticRouting implements RoutingInterface
{
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match(string $url): ?array
    {
        if (isset($this->routes[$url])) {
            return $this->routes[$url];
        }
        return null;
    }
}
