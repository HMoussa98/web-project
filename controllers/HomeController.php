<?php

namespace app\controllers;

use app\core\Controller;
use app\repositories\CardRepository;

class HomeController extends Controller
{
    public function index()
    {
        $cardRepository = new CardRepository();
        $cards = $cardRepository->findAll();

        return $this->render('home', ['cards' => $cards]);
    }
}
