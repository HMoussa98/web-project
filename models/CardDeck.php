<?php

namespace app\models;

// CardDeck.php

namespace app\models;

class CardDeck
{
    private $cardId;
    private $deckId;
    private $quantity;

    /**
     * @return mixed
     */
    public function getCardId()
    {
        return $this->cardId;
    }

    /**
     * @param mixed $cardId
     */
    public function setCardId($cardId): void
    {
        $this->cardId = $cardId;
    }

    /**
     * @return mixed
     */
    public function getDeckId()
    {
        return $this->deckId;
    }

    /**
     * @param mixed $deckId
     */
    public function setDeckId($deckId): void
    {
        $this->deckId = $deckId;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity): void
    {
        $this->quantity = $quantity;
    }

    public function __construct($cardId, $deckId, $quantity)
    {
        $this->cardId = $cardId;
        $this->deckId = $deckId;
        $this->quantity = $quantity;
    }

    // Getter and setter methods for cardId, deckId, and quantity
}
