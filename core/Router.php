<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    public Request $request;

    public function __construct(\app\core\Request $request)
    {
        $this->request = $request;
    }

    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;
        if ($callback === false) {
            return "Not found";
        }
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        return call_user_func($callback);
        // echo '<pre>';
        // var_dump($this->routes);
    }

    public function renderView($view)
    {
        $content = $this->content();
        include_once Application::$ROOT_DIR."/views/$view.php";
    }

    protected function content()
    {   
        ob_start();
        include_once Application::$ROOT_DIR."/views/base.php";
        ob_get_clean();
    }
}