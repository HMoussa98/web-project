<?php

namespace app\Middleware;

use app\Http\Request;
use app\Http\Response;

class Dispatcher {
    private $middlewares = [];

    public function add(Middleware $middleware) {
        $this->middlewares[] = $middleware;
    }

    public function dispatch(Request $request, callable $handler): Response {
        $current = array_reduce(array_reverse($this->middlewares), function ($next, $middleware) {
            return function ($request) use ($middleware, $next) {
                return $middleware->handle($request, $next);
            };
        }, $handler);

        return $current($request);
    }
}