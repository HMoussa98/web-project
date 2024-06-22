<?php

namespace app\Model;

use PDO;

class DeckModel
{
    private $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function createDeck($userId, $name)
    {
        $stmt = $this->db->prepare("INSERT INTO decks (user_id, name) VALUES (:user_id, :name)");
        $stmt->execute([
            'user_id' => $userId,
            'name' => $name,
        ]);
        return $this->db->lastInsertId();
    }

    public function getAllDecksByUserId($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM decks WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeckById($deckId)
    {
        $stmt = $this->db->prepare("SELECT * FROM decks WHERE id = :id");
        $stmt->execute(['id' => $deckId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteDeck($deckId)
    {
        $stmt = $this->db->prepare("DELETE FROM decks WHERE id = :id");
        $stmt->execute(['id' => $deckId]);
    }

    public function addCardToDeck($deckId, $cardId, $count)
    {
        $stmt = $this->db->prepare("INSERT INTO deck_cards (deck_id, card_id, count) VALUES (:deck_id, :card_id, :count)");
        $stmt->execute([
            'deck_id' => $deckId,
            'card_id' => $cardId,
            'count' => $count,
        ]);
    }

    public function removeCardFromDeck($deckId, $cardId)
    {
        $stmt = $this->db->prepare("DELETE FROM deck_cards WHERE deck_id = :deck_id AND card_id = :card_id");
        $stmt->execute([
            'deck_id' => $deckId,
            'card_id' => $cardId,
        ]);
    }

    public function getCardsInDeck($deckId)
    {
        $stmt = $this->db->prepare("SELECT c.* FROM cards c JOIN deck_cards dc ON c.id = dc.card_id WHERE dc.deck_id = :deck_id");
        $stmt->execute(['deck_id' => $deckId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
