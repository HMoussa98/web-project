<?php
// app/controllers/LoginController.php

namespace app\controllers;

use app\core\Controller;
use app\Http\Request;
use app\repositories\UserRepository;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->getBody();

            // Validate input data (e.g., check if username and password are provided)

            // Authenticate user
            $userRepository = new UserRepository();
            $user = $userRepository->findByUsername($data['username']);

            if ($user && password_verify($data['password'], $user->getPassword())) {
                // User is authenticated, proceed with login
                // You can set session variables, cookies, or other authentication mechanisms here

                // Redirect user to a dashboard or profile page
                $this->redirect('/');
            } else {
                // Authentication failed, display error message
                return $this->render('login', ['error' => 'Invalid username or password']);
            }
        }

        // Render the login form
        return $this->render('login');
    }
}
