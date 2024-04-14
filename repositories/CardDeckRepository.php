<?php

namespace app\repositories;
// CardDeckRepository.php

namespace app\repositories;

use app\models\CardDeck;
use app\models\Card;
use app\models\Deck;
use app\Database\Database;

class CardDeckRepository
{
    public function addCardToDeck($cardId, $deckId, $quantity)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("INSERT INTO card_deck (card_id, deck_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$cardId, $deckId, $quantity]);
    }

    public function deleteFromDeck($cardId, $deckId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("DELETE FROM card_deck WHERE card_id = ? AND deck_id = ?");
        $stmt->execute([$cardId, $deckId]);
    }
    public function getCardsInDeck($deckId)
    {
        $pdo = Database::connect();
        $stmt = $pdo->prepare("SELECT c.* FROM cards c JOIN card_deck cd ON c.id = cd.card_id WHERE cd.deck_id = ?");
        $stmt->execute([$deckId]);
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
