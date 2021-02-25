<?php

namespace App\Responses;

use GuzzleHttp\Exception\RequestException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

class ErrorResponse implements ResponseInterface
{
    private Throwable $exception;

    public function __construct(Throwable $exception)
    {
        $this->exception = $exception;
    }

    public function send(): void
    {
        $response = new Response();
        $response->setContent($this->getContent());
        $response->setStatusCode($this->getStatusCode());

        $response->send();
    }

    public function getContent(): string
    {
        return Response::$statusTexts[$this->getStatusCode()] ?? "Unknown Error";
    }

    public function getStatusCode(): int
    {
        if ($this->exception instanceof RequestException && $this->exception->hasResponse()) {
            $statusCode = $this->exception->getResponse()->getStatusCode();
        }

        return $statusCode ?? Response::HTTP_FAILED_DEPENDENCY;
    }

    public function getContentType(): string
    {
        return "text/html";
    }

    public function getContentLength(): int
    {
        return 0;
    }
}
