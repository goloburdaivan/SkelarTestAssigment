<?php

namespace Responses;

use HttpStatus;

require_once './Responses/JsonResponse.php';
require_once './Constants/HttpStatus.php';
class UnauthorizedResponse extends JsonResponse
{
    protected array $data = [
        'error' => 'Unauthorized',
        'code' => HttpStatus::HTTP_UNAUTHORIZED
    ];
    public function __construct()
    {
        header('WWW-Authenticate: Basic realm="Restricted Area"');
        http_response_code(HttpStatus::HTTP_UNAUTHORIZED);
        parent::__construct();
    }
}