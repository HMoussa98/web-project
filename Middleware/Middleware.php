<?php
namespace app\Middleware;

use app\Http\Request;
use app\Http\Response;

interface Middleware {
    public function handle(Request $request, callable $next): Response;
}