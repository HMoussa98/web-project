<?php

namespace YourNamespace\Middleware;

use YourNamespace\Http\RequestInterface;
use YourNamespace\Http\ResponseInterface;

interface MiddlewareInterface
{
    public function process(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface;
}
