<?php

namespace app\repositories;

use app\models\SubscriptionType;
use app\Database\Database;
use app\models\User;

class SubscriptionTypeRepository
{
    public function create(SubscriptionType $subscriptionType)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO subscription_types (name, price) VALUES (?, ?)");
        $stmt->execute([$subscriptionType->getName(), $subscriptionType->getPrice()]);
        $subscriptionType->setId($pdo->lastInsertId());
    }

    public function delete(SubscriptionType $subscriptionType)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM subscription_types WHERE id = ?");
        $stmt->execute([$subscriptionType->getId()]);
    }

    public function addSubscriptionToUser($userId, $subscriptionTypeId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO user_subscriptions (user_id, subscription_type_id) VALUES (?, ?)");
        $stmt->execute([$userId, $subscriptionTypeId]);
    }

    public function removeSubscriptionFromUser($userId, $subscriptionTypeId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM user_subscriptions WHERE user_id = ? AND subscription_type_id = ?");
        $stmt->execute([$userId, $subscriptionTypeId]);
    }


    public function findById($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM subscription_types WHERE id = ?");
        $stmt->execute([$id]);
        $subscriptionTypeData = $stmt->fetch();

        if (!$subscriptionTypeData) {
            return null;
        }

        return new SubscriptionType(
            $subscriptionTypeData['id'],
            $subscriptionTypeData['name'],
            $subscriptionTypeData['price']
        );
    }

    public function findAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM subscription_types");
        $subscriptionTypesData = $stmt->fetchAll();

        $subscriptionTypes = [];
        foreach ($subscriptionTypesData as $subscriptionTypeData) {
            $subscriptionType = new SubscriptionType(
                $subscriptionTypeData['id'],
                $subscriptionTypeData['name'],
                $subscriptionTypeData['price']
            );
            $subscriptionTypes[] = $subscriptionType;
        }

        return $subscriptionTypes;
    }

    public function findAllUsersBySubscriptionType($subscriptionTypeId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT u.* FROM users u INNER JOIN user_subscriptions us ON u.id = us.user_id WHERE us.subscription_type_id = ?");
        $stmt->execute([$subscriptionTypeId]);
        $usersData = $stmt->fetchAll();

        $users = [];
        foreach ($usersData as $userData) {
            $user = new User($userData['id'], $userData['username'], $userData['email'], $userData['password']);
            $users[] = $user;
        }

        return $users;
    }
    // Other CRUD methods as needed
}
