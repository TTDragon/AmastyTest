<?php

namespace Amasty\Trainee;

use Amasty\Trainee\Core\RequestInterface;
use Amasty\Trainee\Core\ResponseInterface;
use Amasty\Trainee\HTTP\Request;
use Amasty\Trainee\HTTP\Router;

class Core
{
    const PATH_PARAM = '____route____';

    private static $request;

    private static $connection;

    public function init(): void
    {
        self::initConnection();
        $this->initRequest();
    }

    private static function initConnection()
    {
        if (self::$connection === null) {
            self::$connection = new \Amasty\Trainee\MySQL();
        }
    }

    public static function getRequest(): RequestInterface
    {
        return self::$request;
    }

    public static function getConnection(): \Amasty\Trainee\MySQL
    {
        return self::$connection;
    }

    public function run(): void
    {
        $this->init();
        $router = new Router();
        $response = $router->dispatch($this->getRequest());
        $this->sendResponse($response);
    }

    private function sendResponse(ResponseInterface $response): void
    {
        http_response_code($response->getStatusCode());
        echo $response->getBody();
    }

    private function initRequest()
    {
        if (self::$request === null) {
            $path = $_GET[self::PATH_PARAM];
            unset($_GET[self::PATH_PARAM]);
            $params = $_GET;
            $post = $_POST;
            self::$request = new Request($params, $post, $path);
        }
    }
}