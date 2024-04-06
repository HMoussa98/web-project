<?php

namespace YourNamespace\Http;

interface RequestInterface
{
    public function getMethod(): string;
    public function getUri(): string;
    public function getHeaders(): array;
    public function getBody(): string;
    // You can add more methods as needed
}

