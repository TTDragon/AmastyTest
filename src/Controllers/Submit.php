<?php

namespace Amasty\Trainee\Controllers;

use Amasty\Trainee\Core;
use Amasty\Trainee\Core\ControllerInterface;
use Amasty\Trainee\Core\ResponseInterface;
use Amasty\Trainee\HTTP\Response;
use Amasty\Trainee\Models\Pizza;

class Submit implements ControllerInterface
{
    public function execute(): ResponseInterface
    {
        $request = Core::getRequest();
        $size = $request->getParam('size');
        $pizzaType = $request->getParam('pizza');
        $sous = $request->getParam('sous');
        $response = new Response();

        if ($size === null || $pizzaType === null || $sous === null) {
            $response->setBody(json_encode(['error' => 'empty selection']));

            return $response;
        }

        try {
            $pizza = new Pizza($size, $sous, $pizzaType);
            $calculator = new \Amasty\Trainee\Calculator();
            $calculation = $calculator->calculate($pizza);
            $responseData = [
                'type' => $pizza->getType(),
                'sous' => $pizza->getSous(),
                'size' => $pizza->getSize(),
                'totals_array' => $calculation
            ];

            $response->setBody(json_encode($responseData));

            return $response;
        } catch (\Exception $e) {
            $response->setBody(json_encode(['error' => $e->getMessage()]));

            return $response;
        }
    }
}