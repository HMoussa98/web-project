<?php
namespace app\Middleware;

use app\Http\Request;
use app\Http\Response;

class RequestLogger implements Middleware {
    public function handle(Request $request, callable $next): Response {
        error_log($request->getMethod() . ' ' . $request->getUri());
        return $next($request);
    }
}