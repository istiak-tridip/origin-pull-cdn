<?php

namespace App\Responses;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class SuccessResponse implements ResponseInterface
{
    private string $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    public function send(): void
    {
        $response = new SymfonyResponse();
        $response->setContent($this->getContent());
        $response->setStatusCode($this->getStatusCode());
        $response->headers->set("Content-Type", $this->getContentType());
        $response->headers->set("Content-Length", $this->getContentLength());

        $response->send();
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getStatusCode(): int
    {
        return Response::HTTP_OK;
    }

    public function getContentType(): string
    {
        return finfo_buffer(finfo_open(FILEINFO_MIME_TYPE), $this->getContent());
    }

    public function getContentLength(): int
    {
        return strlen($this->getContent());
    }
}
