## About

This project is a simple implementation of "Origin Pull" CDN with cache support written in PHP 7.4.

---
Origin pull CDN is a type of CDN where you don't have to upload files to the CDN server instead CDN does it for you. You only rewrite URLs to point to the CDN. When asked for a specific file, the CDN will first go to the
original server, pull the file, cache, and serve it.
