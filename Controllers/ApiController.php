<?php

namespace Controllers;

class ApiController
{
    public function __construct()
    {
        header('Content-Type: application/json');
    }
}