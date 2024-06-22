<?php

namespace app\Controller;

use app\Http\Request;
use app\Http\Response;
use app\View\Template;
use app\Model\Card;

class CardController
{
    private $template;
    private $cardModel;

    public function __construct(Template $template, Card $cardModel)
    {
        $this->template = $template;
        $this->cardModel = $cardModel;
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

    public function show($id): Response
    {
        $card = $this->cardModel->getCardById($id);
        if ($card) {
            return new Response($this->template->render('card_show', ['card' => $card]));
        }
        return new Response('Card not found', 404);
    }
    public function edit2(): Response
    {
        // only to render tempalte 

        return new Response($this->template->render('card_edit', ['']));
    }

    public function edit(Request $request, $id): Response
    {
        // Retrieve the card details by ID
        $card = $this->cardModel->getCardById($id);

        if (!$card) {
            // If card not found, return 404 response
            return new Response('Card not found', 404);
        }

        // If the request method is GET, render the edit form
        if ($request->getMethod() === 'GET') {
            return new Response($this->template->render('card_edit', ['card' => $card]));
        }

        // For any other method (POST, PUT, DELETE), return Method Not Allowed
        return new Response('Method not allowed', 405);
    }


    public function update(Request $request, $id): Response
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
