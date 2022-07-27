<?php

namespace Amasty\Trainee\HTTP;

use Amasty\Trainee\Core\ResponseInterface;

class Response implements ResponseInterface
{
    private array $headers = [];

    private string $body = '';

    private int $statusCode = 200;

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody(string $body): void
    {
        $this->body = $body;
    }

    /**
     * @return int|string
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int|string $code
     */
    public function setStatusCode($code): void
    {
        $this->statusCode = $code;
    }

    public function appendHeader(string $headerName, string $headerValue): void
    {
        $this->headers[$headerName] = $headerValue;
    }
}