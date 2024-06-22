<?php

namespace app\Model;

use app\Model\User;
use PDO;

class UserModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createUser($data)
    {
        $stmt = $this->db->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute([
            'username' => $data['username'],
            'password' => $data['password'],
            'role' => $data['role'],
        ]);
    }

    public function getUserByUsername($username)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $stmt = $this->db->prepare("SELECT * FROM users");
        $stmt->execute();

        // Fetch all rows as associative arrays
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [];
        foreach ($rows as $row) {
            // Create User object for each row
            $user = new User($row['id'], $row['username'], $row['password'], $row['role']);
            $users[] = $user;
        }

        return $users;
    }
    public function deleteUser($id)
    {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE users SET username = :username, role = :role WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'username' => $data['username'],
            'role' => $data['role'],
        ]);

        return $stmt->rowCount() > 0; // Return true if updated rows > 0, otherwise false
    }
}
