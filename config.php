<?php

return [
    "origin" => [
        // Base URI is used with relative requests
        "base_uri" => "https://istiaktridip.net",

        // Float describing the total timeout of the request in seconds.
        // Use 0 to wait indefinitely.
        "timeout"  => 5.0,

        // The origin URIs that should be served from this CDN.
        // Leave the array empty if you want to server all origin URIs.
        "paths"    => [
            "images/.*",
        ],
    ],
    "cache"  => [
        // Absolute Path of the directory where cache entries will be stored.
        "directory" => __DIR__ . "/storage",

        // The lifetime in number of seconds for a cache entry.
        // Use 0 to store the entry indefinitely.
        "lifetime"  => 0,
    ],
];
