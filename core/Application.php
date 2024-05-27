<?php

namespace app\core;

use app\Http\Request;
use app\Http\Response;
use app\Http\Middleware\MiddlewareInterface;

class Application
{

    // const EVENT_BEFORE_REQUEST = 'beforeRequest';
    // const EVENT_AFTER_REQUEST = 'afterRequest';

    // protected array $eventListeners = [];

    public static string $ROOT_DIR;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;

    // public string $layout = 'main';
    // public ?Controller $controller = null;
    // public Database $db;
    // public Session $session;
    // public View $view;
    // public ?UserModel $user;
    // public string $userClass;

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
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            echo $this->router->renderView('_error', [
                'exception' => $e,
            ]);
        }
    }

}
