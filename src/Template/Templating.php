<?php

namespace app\Template;

// Templating.php

use app\Template\TemplatingInterface;

class Templating implements TemplatingInterface
{
    protected $templatesPath;

    public function __construct(string $templatesPath)
    {
        $this->templatesPath = $templatesPath;
    }

    public function render(string $template, array $data = []): string
    {
        $templateFile = $this->templatesPath . '/' . $template;
        if (!file_exists($templateFile)) {
            throw new \InvalidArgumentException("Template file '$template' not found.");
        }

        ob_start();
        extract($data); // Extract variables for use in the template
        include $templateFile;
        return ob_get_clean();
    }
}
