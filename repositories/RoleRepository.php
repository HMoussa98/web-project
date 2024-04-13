<?php

namespace app\repositories;

use app\models\Role;
use app\Database\Database;

class RoleRepository
{
    public function create(Role $role)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO roles (name) VALUES (?)");
        $stmt->execute([$role->getName()]);
        $role->setId($pdo->lastInsertId());
    }

    public function update(Role $role)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE roles SET name = ? WHERE id = ?");
        $stmt->execute([$role->getName(), $role->getId()]);
    }

    public function delete(Role $role)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM roles WHERE id = ?");
        $stmt->execute([$role->getId()]);
    }

    public function findById($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM roles WHERE id = ?");
        $stmt->execute([$id]);
        $roleData = $stmt->fetch();

        if (!$roleData) {
            return null;
        }

        return new Role($roleData['id'], $roleData['name']);
    }

    public function findAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM roles");
        $rolesData = $stmt->fetchAll();

        $roles = [];
        foreach ($rolesData as $roleData) {
            $role = new Role($roleData['id'], $roleData['name']);
            $roles[] = $role;
        }

        return $roles;
    }
}
