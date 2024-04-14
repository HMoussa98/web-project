<?php

namespace app\Http;

class Response implements ResponseInterface
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
}
