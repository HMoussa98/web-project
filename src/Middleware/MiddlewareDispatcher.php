<?php

namespace YourNamespace\Http;

use YourNamespace\Middleware\MiddlewareInterface;

class MiddlewareDispatcher
{
    protected $middlewares = [];

    public function addMiddleware(MiddlewareInterface $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function handle(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $start = function ($request, $response) {
            // This is the final middleware in the chain, it does nothing but return the response
            return $response;
        };

        // Build the stack of middlewares in reverse order
        $middlewares = array_reverse($this->middlewares);

        // Compose the middlewares into a single callable
        foreach ($middlewares as $middleware) {
            $start = function ($request, $response) use ($middleware, $start) {
                return $middleware->process($request, $response, $start);
            };
        }

        // Start processing the middlewares
        return $start($request, $response);
    }
}
