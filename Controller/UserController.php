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

    public function edit(Request $request): Response
    {
        $userId = $request->getIdFromUri();
        if ($request->getMethod() === 'POST') {
            $data = $request->getPostData();

            if (!isset($data['username']) || !isset($data['role'])) {
                return new Response('Missing required fields', 400);
            }

            try {
                $updated = $this->userModel->updateUser($userId, [
                    'username' => $data['username'],
                    'role' => $data['role']
                ]);

                if (!$updated) {
                    return new Response('Failed to update user', 500);
                }

                
                return new Response('User updated successfully', 200);
            } catch (\PDOException $e) {
                return new Response('Failed to update user: ' . $e->getMessage(), 500);
            }
        }

        // Fetch user details for editing
        $user = $this->userModel->getUserById($userId);

        if (!$user) {
            return new Response('User not found', 404);
        }

        // Render the edit form with the user details
        $content = $this->template->render('users/edit', ['user' => $user]);
        return new Response($content);
    }

    public function showForm(): Response
    {
        return new Response($this->template->render('users/edit'));
    }

    public function deleteUser(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $id = $request->getIdFromUri();
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

                // Return a success message or render a success template if needed
                return new Response('User registered successfully <a href="/login">Login</a>', 201);
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

            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION["loggedin"] = true;
            $_SESSION['role'] = $user['role'];

            return new Response('Login successful', 200);
        }

        return new Response($this->template->render('users/login'));
    }

    public function logout(): Response
    {
        session_unset();
        session_destroy();

        return new Response('Logged out successfully', 200);
    }
}
