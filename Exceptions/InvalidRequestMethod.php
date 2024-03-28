<?php

class InvalidRequestMethod extends InvalidArgumentException {
    public function __construct($message = "Invalid request method for this routes", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}