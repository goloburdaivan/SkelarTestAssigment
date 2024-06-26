<?php

namespace Responses;

use HttpStatus;
require_once './Constants/HttpStatus.php';

abstract class JsonResponse
{
    protected array $data = [];

    public function __construct()
    {
        header('Content-Type: application/json');
    }

    public function __toString() : string {
        return json_encode($this->data);
    }
}