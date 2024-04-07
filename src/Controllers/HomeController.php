<?php
namespace app\Controllers;
class HomeController
{
    public function index()
    {
        return ['title' => 'Home Page', 'content' => 'Welcome to the home page.'];
    }
}
