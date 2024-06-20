<?php
namespace app\Controller;

use app\Http\Response;
use app\View\Template;

class CardController {
    protected $template;

    public function __construct(Template $template) {
        $this->template = $template;
    }

    public function show() {
        return new Response($this->template->render('card'));
    }
}