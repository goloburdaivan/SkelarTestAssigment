<?php

namespace Validators;

use InvalidRequestMethod;

class RequestValidator {
    public function validateRequestMethod(string $expectedMethod): void {
        if ($_SERVER['REQUEST_METHOD'] !== $expectedMethod) {
            throw new InvalidRequestMethod();
        }
    }
}