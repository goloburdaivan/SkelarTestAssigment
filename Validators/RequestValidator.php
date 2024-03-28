<?php

namespace Validators;

use InvalidRequestMethod;
require_once './Exceptions/InvalidRequestMethod.php';

class RequestValidator {
    public function validateRequestMethod(string $expectedMethod): void {
        if ($_SERVER['REQUEST_METHOD'] !== $expectedMethod) {
            throw new InvalidRequestMethod();
        }
    }
}