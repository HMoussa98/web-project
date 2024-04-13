<?php

namespace app\mappers;

use app\models\User;
use app\repositories\UserRepository;

class UserDataMapper
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function findById($id)
    {
        return $this->userRepository->findById($id);
    }

    public function create(User $user)
    {
        // Map User entity to database representation and save it using UserRepository
        $this->userRepository->create($user);
    }

    public function update(User $user)
    {
        // Map User entity to database representation and update it using UserRepository
        $this->userRepository->update($user);
    }

    public function delete(User $user)
    {
        // Map User entity to database representation and delete it using UserRepository
        $this->userRepository->delete($user);
    }

    public function findAll()
    {
        // Map User entity to database representation and delete it using UserRepository
        $this->userRepository->findAll();
    }

    // You can add more mapping methods as needed
}
