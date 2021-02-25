<?php

namespace App;

use Doctrine\Common\Cache\FilesystemCache;

class Response
{
    protected array $config;

    protected FilesystemCache $cache;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function send(string $path): void
    {
        // todo
    }

    protected function cache(): FilesystemCache
    {
        return $this->cache ??=
            new FilesystemCache($this->config["cache"]["directory"], ".it");
    }
}
