<?php

namespace app\core;

use app\Http\Request;
use app\Http\Response;
use app\Http\Middleware\MiddlewareInterface;

class Application
{
    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new \app\Http\Request();
        $this->response = new \app\Http\Response();
        $this->router = new Router($this->request, $this->response);
    }

    public static function getInstance($rootPath)
    {
        if (!isset(self::$app)) {
            self::$app = new Application($rootPath);
        }
        return self::$app;
    }

    public function run()
    {
        echo $this->router->resolve();
    }

}
