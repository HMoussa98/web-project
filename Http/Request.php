<?php

namespace app\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\StreamInterface;
use GuzzleHttp\Psr7\Uri;  

class Request implements RequestInterface
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
            new Uri($_SERVER['REQUEST_URI'])
        );
    }

    public function getMethod(): string {
        return $this->method;
    }

    public function getUri(): UriInterface {
        return $this->uri;
    }

    public function getRequestTarget(): string {
        return $this->uri->getPath();
    }

    public function withRequestTarget($requestTarget): static {
        throw new \InvalidArgumentException('Not implemented');
    }

    public function withMethod($method): static {
        throw new \InvalidArgumentException('Not implemented');
    }

    public function withUri(UriInterface $uri, $preserveHost = false): static {
        throw new \InvalidArgumentException('Not implemented');
    }

    public function getProtocolVersion(): string {
        return '1.1';
    }

    public function withProtocolVersion($version): static {
        throw new \InvalidArgumentException('Not implemented');
    }

    public function getHeaders(): array {
        return [];
    }

    public function hasHeader($name): bool {
        return false;
    }

    public function getHeader($name): array {
        return [];
    }

    public function getHeaderLine($name): string {
        return '';
    }

    public function withHeader($name, $value): static {
        throw new \InvalidArgumentException('Not implemented');
    }

    public function withAddedHeader($name, $value): static {
        throw new \InvalidArgumentException('Not implemented');
    }

    public function withoutHeader($name): static {
        throw new \InvalidArgumentException('Not implemented');
    }

    public function getBody(): StreamInterface {
        return null;
    }

    public function withBody($body): static {
        throw new \InvalidArgumentException('Not implemented');
    }
}
