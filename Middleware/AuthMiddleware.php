<?php
// namespace app\Middleware;

// use app\Http\Request;
// use app\Http\Response;
// use app\Auth\Auth;

// class AuthMiddleware extends Middleware {
//     private $auth;
//     private $roles;

//     public function __construct(Auth $auth, $roles = []) {
//         $this->auth = $auth;
//         $this->roles = $roles;
//     }

//     public function handle(Request $request, callable $next): Response {
//         if (!$this->auth->authorize($this->roles)) {
//             return new Response('Forbidden', 403);
//         }
//         return $next($request);
//     }
// }