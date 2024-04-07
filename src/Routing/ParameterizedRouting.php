<?php

namespace app\Routing;

class ParameterizedRouting implements RoutingInterface
{
    private $routes;

    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    public function match(string $url): ?array
    {
        foreach ($this->routes as $pattern => $handler) {
            $regex = str_replace('/', '\/', $pattern);
            if (preg_match("/^$regex$/", $url, $matches)) {
                return $handler;
            }
        }
        return null;
    }

}