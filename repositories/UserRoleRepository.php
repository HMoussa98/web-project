<?php


namespace app\repositories;

use app\models\UserRole;
use app\models\User;
use app\Database\Database;

class UserRoleRepository
{
    public function addRoleToUser($userId, $roleId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)");
        $stmt->execute([$userId, $roleId]);
    }
    public function updateUserRole($userId, $roleId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE user_roles SET role_id = ? WHERE user_id = ?");
        $stmt->execute([$roleId, $userId]);
    }

    public function findById($userId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM user_roles WHERE user_id = ?");
        $stmt->execute([$userId]);
        $userRoleData = $stmt->fetch();

        if (!$userRoleData) {
            return null;
        }

        return new UserRole(
            $userRoleData['user_id'],
            $userRoleData['role_id']
        );
    }



    public function removeRoleFromUser($userId, $roleId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM user_roles WHERE user_id = ? AND role_id = ?");
        $stmt->execute([$userId, $roleId]);
    }
    public function findAllUsersByRole($roleId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT u.* FROM users u JOIN user_roles ur ON u.id = ur.user_id WHERE ur.role_id = ?");
        $stmt->execute([$roleId]);
        $usersData = $stmt->fetchAll();

        $users = [];
        foreach ($usersData as $userData) {
            $user = new User(
                $userData['id'],
                $userData['username'],
                $userData['email'],
                $userData['password']
            // Add more properties if needed
            );
            $users[] = $user;
        }

        return $users;
    }

}
