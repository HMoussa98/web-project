<?php
namespace app\Routing;

interface RoutingInterface
{
public function match(string $url): ?array;
}