<?php

namespace Amasty\Trainee\HTTP;

use Amasty\Trainee\Core\ControllerInterface;
use Amasty\Trainee\Core\RequestInterface;
use Amasty\Trainee\Core\ResponseInterface as ResponseInterfaceAlias;

class Router
{
    public function dispatch(RequestInterface $request): ResponseInterfaceAlias
    {
        $path = $request->getPath();
        $path = trim($path, '/');
        $className = ucfirst($path);
        $fullClassName = 'Amasty\\Trainee\\Controllers\\' . $className;

        if (class_exists($fullClassName)) {
            /** @var ControllerInterface $controller **/
            $controller = new $fullClassName($request);
            $response = $controller->execute();

            return $response;
        } else {
            $response = new Response();
            $response->setStatusCode(404);
            $response->setBody('');

            return $response;
        }
    }
}