<?php

namespace App\Responses;

interface ResponseInterface
{
    public function send(): void;

    public function getContent(): string;

    public function getStatusCode(): int;

    public function getContentType(): string;

    public function getContentLength(): int;
}
