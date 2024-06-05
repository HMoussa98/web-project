<?php

namespace app\Http\Middleware;

use app\Http\Request;
use app\Http\Response;

interface MiddlewareInterface
{
    public function handle(Request $request, Response $response, callable $next);
}