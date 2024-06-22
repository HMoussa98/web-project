<?php

namespace app\Controller;

use app\Http\Request;
use app\Http\Response;
use app\View\Template;
use app\Model\Card;
use app\Model\DeckModel;

class CardController
{
    private $template;
    private $cardModel;
    private $deckModel;


    public function __construct(Template $template, Card $cardModel, DeckModel $deckModel)
    {
        $this->template = $template;
        $this->cardModel = $cardModel;
        $this->deckModel = $deckModel;
    }

    public function showCreateForm(): Response
    {
        return new Response($this->template->render('card_create'));
    }

    public function create(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $data = $request->getPostData();

            // Validate if all required fields are present
            if (
                !isset($data['name']) ||
                !isset($data['attack']) ||
                !isset($data['defense']) ||
                !isset($data['set_name']) ||
                !isset($data['rarity']) ||
                !isset($data['price'])
            ) {
                return new Response('Missing required fields', 400);
            }

            try {
                // Attempt to create a new card
                $this->cardModel->createCard($data);
                return new Response('Card created successfully', 201);
            } catch (\PDOException $e) {
                // Handle database error
                return new Response('Failed to create card: ' . $e->getMessage(), 500);
            }
        }

        // Handle GET request for showing the create form (if needed)
        return new Response($this->template->render('card_create'));
    }


    public function index(): Response
    {
        $cards = $this->cardModel->getAllCards();
        return new Response($this->template->render('card_index', ['cards' => $cards]));
    }

    public function show(Request $request): Response
    {

        $userId = 1;

        $decks = $this->deckModel->getAllDecksByUserId($userId);

        $id = $request->getIdFromUri();
        $card = $this->cardModel->getCardById($id);


        return new Response($this->template->render('card_show', ['card' => $card, 'decks' => $decks]));


        // return new Response('Card not found', 404);
    }
    public function edit2(): Response
    {
        // only to render tempalte 

        return new Response($this->template->render('card_edit', ['']));
    }


    public function delete(Request $request): Response
    {
        if ($request->getMethod() === 'POST') {
            $id = $request->getIdFromUri();

            // Debugging: var dump to check the value of $id
            var_dump($id);

            try {
                $this->cardModel->deleteCard($id);
                return new Response('Card deleted', 200);
            } catch (\Exception $e) {
                return new Response('Failed to delete card: ' . $e->getMessage(), 500);
            }
        } else {
            return new Response('Wrong request method', 400);
        }
    }




    public function edit(Request $request): Response
    {
        // Retrieve the card details by ID
        $id = $request->getIdFromUri();
        $card = $this->cardModel->getCardById($id);

        if (!$card) {
            // If card not found, return 404 response
            return new Response('Card not found', 404);
        }

        // If the request method is GET, render the edit form
        if ($request->getMethod() === 'POST') {
            return new Response($this->template->render('card_edit', ['card' => $card]));
        }

        // For any other method (POST, PUT, DELETE), return Method Not Allowed
        return new Response('Method not allowed', 405);
    }


    public function update(Request $request): Response
    {

        if ($request->getMethod() === 'POST') {
            $data = $request->getPostData();
            $id = $request->getIdFromUri();

            // Validate if all required fields are present
            if (
                !isset($data['name']) ||
                !isset($data['attack']) ||
                !isset($data['defense']) ||
                !isset($data['set_name']) ||
                !isset($data['rarity']) ||
                !isset($data['price'])
            ) {
                return new Response('Missing required fields', 400);
            }

            try {
                // Attempt to update the card
                $this->cardModel->updateCard($id, $data);
                return new Response('Card updated successfully');
            } catch (\PDOException $e) {
                return new Response('Failed to update card: ' . $e->getMessage(), 500);
            }
        }
        return new Response('Method not allowed', 405);
    }
}
