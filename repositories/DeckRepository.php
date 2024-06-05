<?php
// DeckRepository.php

namespace app\repositories;

use app\models\Deck;
use app\Database\Database;

class DeckRepository
{
    public function create(Deck $deck)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO decks (user_id, name) VALUES (?, ?)");
        $stmt->execute([$deck->getUserId(), $deck->getName()]);
        $deck->setId($pdo->lastInsertId());
    }

    public function findById($id)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM decks WHERE id = ?");
        $stmt->execute([$id]);
        $deckData = $stmt->fetch();

        if (!$deckData) {
            return null;
        }

        return new Deck($deckData['id'], $deckData['user_id'], $deckData['name']);
    }

    public function findAll()
    {
        $pdo = Database::connect();
        $stmt = $pdo->query("SELECT * FROM decks");
        $decksData = $stmt->fetchAll();

        $decks = [];
        foreach ($decksData as $deckData) {
            $deck = new Deck($deckData['id'], $deckData['user_id'], $deckData['name']);
            $decks[] = $deck;
        }

        return $decks;
    }

    public function update(Deck $deck)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("UPDATE decks SET user_id = ?, name = ? WHERE id = ?");
        $stmt->execute([$deck->getUserId(), $deck->getName(), $deck->getId()]);
    }

    public function delete(Deck $deck)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM decks WHERE id = ?");
        $stmt->execute([$deck->getId()]);
    }


    public function findAllDecksByUser($userId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT * FROM decks WHERE user_id = ?");
        $stmt->execute([$userId]);
        $decksData = $stmt->fetchAll();

        $decks = [];
        foreach ($decksData as $deckData) {
            $deck = new Deck(
                $deckData['id'],
                $deckData['user_id'],
                $deckData['name']
            // Add more properties if needed
            );
            $decks[] = $deck;
        }

        return $decks;
    }
}
