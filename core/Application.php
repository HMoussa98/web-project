<?php

class Application
{
    public Database $db;

    public function __construct($rootPath){

        $this->db = new Database();


    }
}

