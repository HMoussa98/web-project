<?php
// TemplatingInterface.php

namespace app\Template;

interface TemplatingInterface
{
    public function render(string $template, array $data = []): string;
}
