<?php
namespace app\Controller;

use app\Http\Response;

class CardController {
    private $template;

    public function __construct(Template $template) {
        $this->template = $template;
    }

    public function index() {
        return new Response($this->template->render('home'));
    }

    public function show($id) {
        return new Response($this->template->render('card', ['id' => $id]));
    }
}