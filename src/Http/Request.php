<?php

namespace YourNamespace\Http;

class Request implements RequestInterface
{
    protected $method;
    protected $uri;
    protected $headers;
    protected $body;

    public function __construct(string $method, string $uri, array $headers, string $body)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->body = $body;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}
