<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Card;
use app\repositories\CardRepository;

class CardController extends Controller
{
    public function index()
    {
        // Render the add card form
        return $this->render('addCards');
    }

    public function addCard()
    {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve form data
            $name = $_POST['name'];
            $set_id = $_POST['set_id'];
            $rarity = $_POST['rarity'];
            $market_price = $_POST['market_price'];
            $image_path = $_POST['image_path'];

            // Create a new Card object
            $card = new Card(null, $name, $set_id, $rarity, $market_price, $image_path);

            // Create a new CardRepository instance
            $cardRepository = new CardRepository();

            // Add the card to the database
            $cardRepository->create($card);

            // Redirect to the index method to render the addCards view
            $this->redirect('/');
        }

        // Render the add card form
        return $this->render('addCards');
    }
}
