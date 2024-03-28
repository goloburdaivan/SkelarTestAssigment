<?php

namespace Responses;

use HttpStatus;

require_once './Responses/JsonResponse.php';
require_once './Constants/HttpStatus.php';
class NotFoundResponse extends JsonResponse
{
    protected array $data = [
        'error' => 'Resource not found!',
        'code' => HttpStatus::HTTP_NOT_FOUND
    ];
    public function __construct()
    {
        parent::__construct();
    }
}