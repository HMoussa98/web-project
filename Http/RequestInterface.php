<?php

namespace app\Http;

interface RequestInterface
{
    public function method();
    public function getPath();
    public function isGet();
    public function isPost();
    public function getBody();
}
