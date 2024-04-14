<?php

namespace app\Http;

interface RequestInterface
{
    public function getPath();
    public function method();
    public function isGet();
    public function isPost();
    public function getBody();
}
