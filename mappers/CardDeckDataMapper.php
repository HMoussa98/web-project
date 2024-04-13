<?php

// CardDeckDataMapper.php

namespace app\mappers;

use app\models\CardDeck;
use app\repositories\CardDeckRepository;

class CardDeckDataMapper
{
    private $cardDeckRepository;

    public function __construct(CardDeckRepository $cardDeckRepository)
    {
        $this->cardDeckRepository = $cardDeckRepository;
    }

    public function addCardToDeck($cardId, $deckId, $quantity)
    {
        $this->cardDeckRepository->addCardToDeck($cardId, $deckId, $quantity);
    }

    // Implement other mapping methods as needed
}
