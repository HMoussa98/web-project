<?php

namespace app\Http;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;
use GuzzleHttp\Psr7\Stream;

class Response implements ResponseInterface
{
    private $statusCode;
    private $reasonPhrase;
    private $headers = [];
    private $body;
    private $protocolVersion = '1.1';

    private static $phrases = [
        200 => 'OK',
        400 => 'Bad Request',
        404 => 'Not Found',
        500 => 'Internal Server Error',
    ];

    public function __construct($body = '', $statusCode = 200, $headers = []) {
        $this->body = $body instanceof StreamInterface ? $body : new Stream(fopen('php://temp', 'r+'));
        $this->statusCode = $statusCode;
        $this->reasonPhrase = self::$phrases[$statusCode] ?? '';
        $this->headers = is_array($headers) ? $headers : [];
    }

    public function send() {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $values) {
            foreach ((array)        $values as $value) {
                header("$name: $value", false);
            }
        }
        echo $this->body;
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function withStatus($code, $reasonPhrase = ''): self {
        $new = clone $this;
        $new->statusCode = $code;
        $new->reasonPhrase = $reasonPhrase ?: (self::$phrases[$code] ?? '');
        return $new;
    }

    public function getReasonPhrase(): string {
        return $this->reasonPhrase;
    }

    public function getProtocolVersion(): string {
        return $this->protocolVersion;
    }

    public function withProtocolVersion($version): self {
        $new = clone $this;
        $new->protocolVersion = $version;
        return $new;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function hasHeader($name): bool {
        return isset($this->headers[$name]);
    }

    public function getHeader($name): array {
        return $this->headers[$name] ?? []; 
    }

    public function getHeaderLine($name): string {
        return implode(', ', $this->headers[$name] ?? []);
    }

    public function withHeader($name, $value): self {
        $new = clone $this;
        $new->headers[$name] = (array) $value;
        return $new;
    }

    public function withAddedHeader($name, $value): self {
        $new = clone $this;
        if (!isset($new->headers[$name])) {
            $new->headers[$name] = [];
        }
        $new->headers[$name][] = $value;
        return $new;
    }

    public function withoutHeader($name): self {
        $new = clone $this;
        unset($new->headers[$name]);
        return $new;
    }

    public function getBody(): StreamInterface {
        return $this->body;
    }

    public function withBody(StreamInterface $body): self {
        $new = clone $this;
        $new->body = $body;
        return $new;
    }
}
