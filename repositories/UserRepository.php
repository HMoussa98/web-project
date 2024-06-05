<?php

namespace app\repositories;

use app\models\User;
use app\Database\Database;

class UserRepository
{
    public function findById($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $userData = $stmt->fetch();

        if (!$userData) {
            return null;
        }

        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
    }

    public function findByUsername($username)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $userData = $stmt->fetch();

        if (!$userData) {
            return null;
        }

        return new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
    }

    public function findAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM users");
        $usersData = $stmt->fetchAll();

        $users = [];
        foreach ($usersData as $userData) {
            $user = new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
            $users[] = $user;
        }

        return $users;
    }

    public function create(User $user)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getPassword()]);
        $userId = $pdo->lastInsertId();

        // Assign the default role (user) to the user
        $userRoleRepository = new UserRoleRepository();
        $userRoleRepository->addRoleToUser($userId, 2); // Assuming role ID 2 corresponds to the user role

        // Assign the default subscription type (free) to the user
        $subscriptionTypeRepository = new SubscriptionTypeRepository();
        $subscriptionTypeRepository->addSubscriptionToUser($userId, 1); // Assuming subscription type ID 1 corresponds to the free subscription

        // Set the ID for the user object
        $user->setId($userId);
    }


    public function update(User $user)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?");
        $stmt->execute([$user->getUsername(), $user->getEmail(), $user->getPassword(), $user->getId()]);
    }

    public function delete(User $user)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$user->getId()]);
    }
}
