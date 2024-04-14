<?php

namespace app\repositories;


use app\models\Set;
use app\Database\Database;
use app\models\Card;

class SetRepository
{
    public function create(Set $set)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO sets (name, release_date) VALUES (?, ?)");
        $stmt->execute([$set->getName(), $set->getReleaseDate()]);
        $set->setId($pdo->lastInsertId());
    }

    public function update(Set $set)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE sets SET name = ?, release_date = ? WHERE id = ?");
        $stmt->execute([$set->getName(), $set->getReleaseDate(), $set->getId()]);
    }

    public function delete(Set $set)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM sets WHERE id = ?");
        $stmt->execute([$set->getId()]);
    }

    public function findById($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM sets WHERE id = ?");
        $stmt->execute([$id]);
        $setData = $stmt->fetch();

        if (!$setData) {
            return null;
        }

        return new Set($setData['id'], $setData['name'], $setData['release_date']);
    }

    public function findAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM sets");
        $setsData = $stmt->fetchAll();

        $sets = [];
        foreach ($setsData as $setData) {
            $set = new Set($setData['id'], $setData['name'], $setData['release_date']);
            $sets[] = $set;
        }

        return $sets;
    }

    public function getCardsInSet($setId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM cards c WHERE c.set_id = ?");
        $stmt->execute([$setId]);
        $cardsData = $stmt->fetchAll();

        $cards = [];
        foreach ($cardsData as $cardData) {
            $card = new Card(
                $cardData['id'],
                $cardData['name'],
                $cardData['set_id'],
                $cardData['rarity'],
                $cardData['market_price'],
                $cardData['image_path']
            );
            $cards[] = $card;
        }

        return $cards;
    }
}
