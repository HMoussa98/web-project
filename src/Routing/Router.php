<?php

namespace app\Routing;

class Router
{
    private $strategies = [];

    public function addStrategy(string $name, RoutingInterface $strategy)
    {
        $this->strategies[$name] = $strategy;
    }

    public function matchRoute(string $url): ?array
    {
        foreach ($this->strategies as $strategy) {
            $match = $strategy->match($url);
            if ($match !== null) {
                return $match;
            }
        }
        return null;
    }
}
