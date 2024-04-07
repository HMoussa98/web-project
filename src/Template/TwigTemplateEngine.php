<?php

namespace app\Template;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use app\Container\ContainerInterface;
class TwigTemplateEngine implements TemplateEngineInterface
{
    /** @var Environment */


    /**
     * Constructor.
     *
     * @param string $templateDir The directory where template files are located.
     */
    protected $twig;

    public function __construct()
    {
        // Initialize Twig environment here
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new \Twig\Environment($loader);
    }

    /**
     * Load a template file.
     *
     * @param string $templateName The name or path of the template file.
     * @return void
     */
    public function loadTemplate(string $templateName): void
    {
        // Not needed in Twig, as Twig automatically loads templates when rendering
    }

    /**
     * Render a template with the given data.
     *
     * @param array $data The data to pass to the template.
     * @return string The rendered template content.
         */
    public function render(string $templateName, array $data = []): string
    {
        return $this->twig->render($templateName, $data);
    }
    }

?>
