<?php
namespace app\View;

class Template {
    private $templatePath;

    public function __construct($templatePath) {
        $this->templatePath = $templatePath;
    }

    public function render($template, $data = []) {
        ob_start();
        extract($data);
        include $this->templatePath . '/' . $template . '.php';
        return ob_get_clean();
    }
}