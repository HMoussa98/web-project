<?php

namespace app\Http;

class Request
{
    private $method;
    private $uri;

    public function __construct($method, $uri) {
        $this->method = $method;
        $this->uri = $uri;
    }

    public static function fromGlobals(): self {
        return new self(
            $_SERVER['REQUEST_METHOD'],
            $_SERVER['REQUEST_URI']
        );
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getUri(): string {
        return $this->uri;
    }
}
