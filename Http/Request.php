<?php

namespace app\Http;

class Request
{
    private $method;
    private $uri;
    private $body;
    private $postData;

    public function __construct($method, $uri)
    {
        $this->method = $method;
        $this->uri = $uri;
        $this->body = file_get_contents('php://input');
        $this->postData = $_POST;
    }

    public static function fromGlobals(): self
    {
        return new self(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI']
        );
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getPostData(): array
    {
        return $this->postData;
    }
    public function getIdFromUri(): int
    {
        $uriParts = explode('/', trim($this->uri, '/'));
        return (int) end($uriParts);
    }
}
