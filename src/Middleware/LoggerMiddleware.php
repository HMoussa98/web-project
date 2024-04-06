<?php

namespace app\Middleware;

use app\Http\RequestInterface;
use app\Http\ResponseInterface;

class LoggerMiddleware implements MiddlewareInterface
{
    public function process(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        // Log request information
        $this->logRequest($request);

        // Call the next middleware in the chain
        $response = $next($request, $response);

        // Log response information
        $this->logResponse($response);

        return $response;
    }

    protected function logRequest(RequestInterface $request)
    {
        // Log request details
        echo "Request: {$request->getMethod()} {$request->getUri()}\n";
    }

    protected function logResponse(ResponseInterface $response)
    {
        // Log response details
        echo "Response Status: {$response->getStatusCode()}\n";
    }
}
