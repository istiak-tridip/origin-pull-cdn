<?php

namespace App;

use App\Responses\ErrorResponse;
use App\Responses\NotAllowedResponse;
use App\Responses\SuccessResponse;
use Doctrine\Common\Cache\FilesystemCache;
use Exception;
use GuzzleHttp\Client;
use Throwable;

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
        $this->checkIfPathIsAllowed($path);

        try {
            $key = $this->getCacheKey($path);
            if (!$this->cache()->contains($key)) {
                $this->fetchFileContent($path);
            }

            $content  = $this->cache()->fetch($path);
            $response = new SuccessResponse($content);
            $response->send();
        } catch (Throwable $exception) {
            $response = new ErrorResponse($exception);
            $response->send();
        }
    }

    protected function fetchFileContent(string $path): void
    {
        $client   = $this->client();
        $response = $client->get($path);

        $key = $this->getCacheKey($path);
        if (!$this->cacheFileContent($key, $response->getBody())) {
            throw new Exception("Failed to cache file content.");
        }
    }

    protected function cacheFileContent(string $path, string $contents): bool
    {
        return $this->cache()->save(
            $path,
            $contents,
            $this->config["cache"]["lifetime"]
        );
    }

    protected function client(): Client
    {
        return new Client([
            "base_uri" => $this->config["origin"]["base_uri"],
            "timeout"  => $this->config["origin"]["timeout"],
            "headers"  => [
                "User-Agent" => "OPCDN-BOT/0.1.0",
            ],
        ]);
    }

    protected function cache(): FilesystemCache
    {
        return $this->cache ??=
            new FilesystemCache($this->config["cache"]["directory"], ".it");
    }

    protected function checkIfPathIsAllowed(string $path): void
    {
        if (empty($paths = $this->config["origin"]["paths"])) {
            return;
        }

        foreach ($paths as $pattern) {
            if ($this->pathMatches($pattern, $path) === false) {
                $response = new NotAllowedResponse($path);
                $response->send();
            }
        }
    }

    protected function pathMatches(string $pattern, string $path): bool
    {
        if ($pattern === $path) {
            return true;
        }

        $path = trim($path, "/");

        return preg_match('#^' . $pattern . '\z#u', $path) === 1;
    }

    protected function getCacheKey(string $path): string
    {
        $host = parse_url($this->config["origin"]["base_uri"], PHP_URL_HOST);

        return $host . "::" . $path;
    }
}
