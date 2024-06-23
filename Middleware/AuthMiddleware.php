<?php
namespace app\Middleware;

use app\Http\Request;
use app\Http\Response;

class AuthMiddleware implements Middleware {
    private $loggedout = ['/login', '/register'];
    private $admin = ['/users', '/users/edit/{id}', '/users/delete/{id}', '/cards/create'];
    private $premium = ['/decks', '/deck/{id}', '/deck/remove/{id}', '/deck/make'];

    public function handle(Request $request, callable $next): Response {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $uri = $request->getUri();
        $isAdminRoute = $this->isRoute($uri, $this->admin);
        $isPremiumRoute = $this->isRoute($uri, $this->premium);

        
        if (in_array($uri, $this->loggedout)) {
            return $next($request);
        }

        // Redirect to login if user is not authenticated
        if (!isset($_SESSION['user_id'])) {
            $response = new Response('', 302);
            $response->setHeader('Location', '/login');
            return $response;
        }

        // Allow access to admin routes only for admins
        if ($isAdminRoute && (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin')) {
            return new Response('Forbidden', 403);
        }

        // Allow access to premium routes for admins and premium users
        if ($isPremiumRoute && (!isset($_SESSION['role']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'premium'))) {
            return new Response('Forbidden', 403);
        }

        return $next($request);
    }

    private function isRoute($uri, $arr) {
        foreach ($arr as $route) {
            $regex = $this->convertUriToRegex($route);
            if (preg_match($regex, $uri)) {
                return true;
            }
        }
        return false;
    }

    private function convertUriToRegex($uri) {
        return '@^' . preg_replace('/{[\w]+}/', '[\w-]+', $uri) . '$@';
    }
}
?>
