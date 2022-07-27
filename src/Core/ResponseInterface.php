<?php

namespace Amasty\Trainee\Core;

interface ResponseInterface
{
    public function getStatusCode(): int;

    public function setStatusCode(int $code): void;

    public function setBody(string $body): void;

    public function getBody(): string;

    public function appendHeader(string $headerName, string $headerValue): void;
}