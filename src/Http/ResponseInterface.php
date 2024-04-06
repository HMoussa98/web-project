<?php
namespace app\Http;

interface ResponseInterface
{
    public function withStatus(int $code, string $reasonPhrase = ''): ResponseInterface;
    public function withHeader(string $name, string $value): ResponseInterface;
    public function withBody(string $body): ResponseInterface;
    public function send(): void;
    // You can add more methods as needed
}