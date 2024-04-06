<?php

namespace app\Http;

class Response implements ResponseInterface
{
    protected $statusCode = 200;
    protected $headers = [];
    protected $body = '';

    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface
    {
        $this->statusCode = $code;
        // You can handle reason phrase if needed
        return $this;
    }

    public function withHeader(string $name, string $value): ResponseInterface
    {
        $this->headers[$name] = $value;
        return $this;
    }

    public function withBody(string $body): ResponseInterface
    {
        $this->body = $body;
        return $this;
    }

    public function send(): void
    {
        // Send HTTP headers
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }

        // Send HTTP status code
        http_response_code($this->statusCode);

        // Send HTTP response body
        echo $this->body;
    }
}
