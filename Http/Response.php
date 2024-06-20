<?php

namespace app\Http;

class Response
{
    private $body;
    private $status;

    public function __construct($body = '', $status = 200) {
        $this->body = $body;
        $this->status = $status;
    }

    public function send() {
        http_response_code($this->status);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->body;
    }
}
