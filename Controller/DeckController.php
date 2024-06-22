<?php

namespace app\Controller;

use app\Http\Request;
use app\Http\Response;
use app\View\Template;
use app\Model\DeckModel;

class DeckController
{
    private $template;
    private $deckModel;

    public function __construct(Template $template, DeckModel $deckModel)
    {
        $this->template = $template;
        $this->deckModel = $deckModel;
    }

    public function make(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getPostData();

            if (!isset($data['name'])) {
                return new Response('Deck name is required', 400);
            }

            // Replace with user authentication logic to get userId
            $userId = 1; // Replace with actual user ID

            try {
                $deckId = $this->deckModel->createDeck($userId, $data['name']);
                return new Response("Deck created with ID: $deckId", 201);
            } catch (\PDOException $e) {
                return new Response('Failed to create deck: ' . $e->getMessage(), 500);
            }
        }

        return new Response($this->template->render('decks/make'));
    }

    public function showForm(): Response
    {
        return new Response($this->template->render('decks/make'));
    }

    public function show(Request $request, $deckId): Response
    {
        // Replace with user authentication logic to get userId
        $userId = 1; // Replace with actual user ID

        $deckId = $request->getIdFromUri();



        $cards = $this->deckModel->getCardsInDeck($deckId);
        $deck = $this->deckModel->getDeckById($deckId);
        var_dump($deck);
        $content = $this->template->render('decks/show', [

            'cards' => $cards,
            'deck' => $deck,
        ]);

        return new Response($content);
    }

    public function delete(Request $request): Response
    {
        // Replace with user authentication logic to get userId
        $userId = 1; // Replace with actual user ID

        $deckId = $request->getIdFromUri();



        $this->deckModel->deleteDeck($deckId);

        // Redirect to /decks after deletion
        return new Response('', 303, ['Location' => '/decks']);
    }

    public function index(Request $request): Response
    {
        // Replace with user authentication logic to get userId
        $userId = 1; // Replace with actual user ID

        $decks = $this->deckModel->getAllDecksByUserId($userId);

        $content = $this->template->render('decks/index', [
            'decks' => $decks,
        ]);

        return new Response($content);
    }

    public function addCardToDeck(Request $request, $cardId): Response
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getPostData();
            $deckId = (int) ($data['deck_id'] ?? 0);
            $cardId = $request->getIdFromUri();
            // var_dump($deckId);

            if (!isset($data['deck_id'])) {
                return new Response('Deck ID is required', 400);
            }

            // Replace with user authentication logic to get userId
            $userId = 1; // Replace with actual user ID

            $deck = $this->deckModel->getDeckById($deckId);

            if (!$deck || $deck['user_id'] != $userId) {
                return new Response('Deck not found or you do not have permission to add cards to it', 404);
            }

            try {
                // Replace count with the actual count you want to add
                $count = 1; // Example: adding 1 card
                $this->deckModel->addCardToDeck($deckId, $cardId, $count);
                return new Response('Card added to deck successfully', 200);
            } catch (\PDOException $e) {
                return new Response('Failed to add card to deck: ' . $e->getMessage(), 500);
            }
        }

        return new Response('Method not allowed', 405);
    }
}
