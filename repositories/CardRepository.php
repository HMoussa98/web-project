<?php

namespace app\repositories;

use app\models\Card;
use app\Database\Database;

class CardRepository
{
    public function create(Card $card)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO cards (name, set_id, rarity, market_price, image_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$card->getName(), $card->getSetId(), $card->getRarity(), $card->getMarketPrice(), $card->getImagePath()]);
        $card->setId($pdo->lastInsertId());
    }

    public function findAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM cards");
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

    public function findById($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM cards WHERE id = ?");
        $stmt->execute([$id]);
        $cardData = $stmt->fetch();

        if (!$cardData) {
            return null;
        }

        return new Card(
            $cardData['id'],
            $cardData['name'],
            $cardData['set_id'],
            $cardData['rarity'],
            $cardData['market_price'],
            $cardData['image_path']
        );
    }


    public function update(Card $card)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE cards SET name = ?, set_id = ?, rarity = ?, market_price = ?, image_path = ? WHERE id = ?");
        $stmt->execute([$card->getName(), $card->getSetId(), $card->getRarity(), $card->getMarketPrice(), $card->getImagePath(), $card->getId()]);
    }

    public function delete(Card $card)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM cards WHERE id = ?");
        $stmt->execute([$card->getId()]);
    }
}
