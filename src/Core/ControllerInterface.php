<?php

namespace Amasty\Trainee\Core;

interface ControllerInterface
{
    public function execute(): ResponseInterface;
}