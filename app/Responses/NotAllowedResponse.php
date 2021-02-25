<?php

namespace App\Responses;

use Symfony\Component\HttpFoundation\Response;

class NotAllowedResponse implements ResponseInterface
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
    }

    public function send(): void
    {
        $response = new Response();
        $response->setContent($this->getContent());
        $response->setStatusCode($this->getStatusCode());

        $response->send();
        exit;
    }

    public function getContent(): string
    {
        return "Path ({$this->path}) is not allowed.";
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_BAD_REQUEST;
    }

    public function getContentType(): string
    {
        return "";
    }

    public function getContentLength(): int
    {
        return 0;
    }
}
