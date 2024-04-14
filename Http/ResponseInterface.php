<?php

namespace app\Http;

interface ResponseInterface
{
    public function setStatusCode(int $code);
}
