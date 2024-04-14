<?php

namespace app\controllers;

use app\core\Controller;
use app\Http\Request;
use app\repositories\UserRepository;
use app\models\User;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        if ($request->isPost()) {
            $data = $request->getBody();
            $user = new User();
            $userRepository = new UserRepository();
            $user->setUsername($data['username']);
            $user->setEmail($data['email']);
            $user->setPassword(password_hash($data['password'], PASSWORD_DEFAULT));


            $userRepository->create($user);

            // Redirect or show success message
            $this->redirect('/');
        }

        return $this->render('register');
    }
}