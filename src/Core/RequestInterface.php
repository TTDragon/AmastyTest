<?php

namespace Amasty\Trainee\Core;

interface RequestInterface
{
    /**
     * @return array
     */
   public function getParams(): array;

    /**
     * @param string $paramName
     * @param null|mixed $defaultValue
     * @return string|null
     */
   public function getParam(string $paramName, $defaultValue = null);
}