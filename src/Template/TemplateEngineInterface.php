<?php

namespace app\Template;

interface TemplateEngineInterface
{
    /**
     * Load a template file.
     *
     * @param string $templateName The name or path of the template file.
     * @return void
     */
    public function loadTemplate(string $templateName): void;

    /**
     * Render a template with the given data.
     *
     * @param string $templateName The name or path of the template file.
     * @param array $data The data to pass to the template.
     * @return string The rendered template content.
     */
    public function render(string $templateName, array $data = []): string;
}