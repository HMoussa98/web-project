<?php

namespace app\Middleware;

use app\Http\RequestInterface;
use app\Http\ResponseInterface;

interface MiddlewareInterface
{
    public function process(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface;
}
