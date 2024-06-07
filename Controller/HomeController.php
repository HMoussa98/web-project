<?php
namespace app\Controller;

use app\Http\Response;
use app\View\Template;

class HomeController {
    protected $template;

    public function __construct(Template $template) {
        $this->template = $template;
    }

    public function index() {
        return new Response($this->template->render('home'));
    }
}