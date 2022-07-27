<?php

namespace Amasty\Trainee\HTTP;

use Amasty\Trainee\Core\RequestInterface;

class Request implements RequestInterface
{
    /**
     * @var array
     */
    private array $params;

    /**
     * @var array
     */
    private array $post;

    /**
     * @var string
     */
    private string $path;

    public function __construct(
        array $params = [],
        array $post = [],
        string $path
    ) {
        $this->params = $params;
        $this->post = $post;
        $this->path = $path;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $paramName, $defaultValue = null)
    {
        if (array_key_exists($paramName, $this->params)) {
            return $this->params[$paramName];
        }

        if (array_key_exists($paramName, $this->post)) {
            return $this->post[$paramName];
        }

        return $defaultValue;
    }

    public function getPath(): string
    {
       return $this->path;
    }
}