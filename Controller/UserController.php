<?php

namespace app\Controller;

use app\Http\Request;
use app\Http\Response;
use app\View\Template;
use app\Model\UserModel;

class UserController
{
    private $template;
    private $userModel;

    public function __construct(Template $template, UserModel $userModel)
    {
        $this->template = $template;
        $this->userModel = $userModel;
    }

    public function index(): Response
    {
        $users = $this->userModel->getAllUsers();
        $content = $this->template->render('users/index', ['users' => $users]);
        return new Response($content);
    }

    public function deleteUser(Request $request, $id): Response
    {
        if ($request->getMethod() === 'POST') {
            $this->userModel->deleteUser($id);
            return new Response('', 303, ['Location' => '/users']);
        } else {
            return new Response('Method Not Allowed', 405);
        }
    }

    public function showRegisterForm(): Response
    {
        return new Response($this->template->render('users/register'));
    }

    public function register(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getPostData();

            if (!isset($data['username']) || !isset($data['password'])) {
                return new Response('Missing required fields', 400);
            }

            $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

            try {
                $user = $this->userModel->createUser([
                    'username' => $data['username'],
                    'password' => $hashedPassword,
                    'role' => 'user'
                ]);

                // Store username and user_id in session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                // Return a success message or render a success template if needed
                return new Response('User registered successfully', 201);
            } catch (\PDOException $e) {
                return new Response('Failed to register user: ' . $e->getMessage(), 500);
            }
        }

        return new Response($this->template->render('users/register'));
    }

    public function showLoginForm(): Response
    {
        return new Response($this->template->render('users/login'));
    }

    public function login(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getPostData();

            if (!isset($data['username']) || !isset($data['password'])) {
                return new Response('Username and password are required', 400);
            }

            $username = $data['username'];
            $password = $data['password'];

            $user = $this->userModel->getUserByUsername($username);

            if (!$user || !password_verify($password, $user['password'])) {
                return new Response('Invalid username or password', 401);
            }

            // Store username and user_id in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Return a success message or render a success template if needed
            return new Response('Login successful', 200);
        }

        return new Response($this->template->render('users/login'));
    }

    public function logout(): Response
    {
        // Delete session variables
        session_unset();
        session_destroy();

        // Redirect to home page or render a logout confirmation message
        return new Response('Logged out successfully', 200);
    }
}
