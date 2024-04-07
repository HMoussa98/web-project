<?php

namespace app\Controllers;

class ContactController
{
    public function index()
    {
        return ['title' => 'Contact Page', 'content' => 'Welcome to the contact page.'];
    }
}
