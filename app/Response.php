<?php

namespace App;

class Response
{
    protected array $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function send(string $path): void
    {
        // todo
    }
}
