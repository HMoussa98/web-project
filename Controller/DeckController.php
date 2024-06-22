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

        $deck = $this->deckModel->getDeckById($deckId);

        if (!$deck || $deck['user_id'] != $userId) {
            return new Response('Deck not found or you do not have permission to view it', 404);
        }

        $cards = $this->deckModel->getCardsInDeck($deckId);

        $content = $this->template->render('decks/show', [
            'deck' => $deck,
            'cards' => $cards,
        ]);

        return new Response($content);
    }

    public function delete(Request $request, $deckId): Response
    {
        // Replace with user authentication logic to get userId
        $userId = 1; // Replace with actual user ID

        $deck = $this->deckModel->getDeckById($deckId);

        if (!$deck || $deck['user_id'] != $userId) {
            return new Response('Deck not found or you do not have permission to delete it', 404);
        }

        $this->deckModel->deleteDeck($deckId);

        // Redirect to /decks after deletion
        return new Response('', 303, ['Location' => '/decks']);
    }
}
