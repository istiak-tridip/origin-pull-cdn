<?php

return [
    "origin" => [
        // Base URI is used with relative requests
        "base_uri" => "https://istiaktridip.net",

        // Float describing the total timeout of the request in seconds.
        // Use 0 to wait indefinitely.
        "timeout"  => 5.0,
    ],
    "cache"  => [
        // Absolute Path of the directory where cache entries will be stored.
        "directory" => __DIR__ . "/storage",

        // The lifetime in number of seconds for a cache entry.
        // If zero (the default), the entry never expires.
        "lifetime"  => 0,
    ],
];
