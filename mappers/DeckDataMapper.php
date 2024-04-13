<?php
// DeckDataMapper.php

namespace app\mappers;

use app\models\Deck;
use app\repositories\DeckRepository;

class DeckDataMapper
{
    private $deckRepository;

    public function __construct(DeckRepository $deckRepository)
    {
        $this->deckRepository = $deckRepository;
    }

    public function findById($id)
    {
        return $this->deckRepository->findById($id);
    }

    public function findAll()
    {
        return $this->deckRepository->findAll();
    }

    public function create(Deck $deck)
    {
        $this->deckRepository->create($deck);
    }

    public function update(Deck $deck)
    {
        $this->deckRepository->update($deck);
    }

    public function delete(Deck $deck)
    {
        $this->deckRepository->delete($deck);
    }
}
