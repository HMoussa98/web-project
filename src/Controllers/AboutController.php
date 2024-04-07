<?php

namespace app\Controllers;

class AboutController
{
    public function index()
    {
        return ['title' => 'About Page', 'content' => 'Welcome to the about page.'];
    }
}
