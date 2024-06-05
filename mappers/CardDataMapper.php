<?php

namespace app\mappers;

use app\models\Card;
use app\repositories\CardRepository;

class CardDataMapper
{
    private $cardRepository;

    public function __construct(CardRepository $cardRepository)
    {
        $this->cardRepository = $cardRepository;
    }

    public function findById($id)
    {
        return $this->cardRepository->findById($id);
    }

    public function findAll()
    {
        return $this->cardRepository->findAll();
    }

    public function create(Card $card)
    {
        $this->cardRepository->create($card);
    }

    public function update(Card $card)
    {
        $this->cardRepository->update($card);
    }

    public function delete(Card $card)
    {
        $this->cardRepository->delete($card);
    }

    // Other mapping methods...
}
