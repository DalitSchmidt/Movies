<?php
class SchemaException extends Exception {
    private $errors = [];

    public function __construct(array $errors, $code = 0, Exception $previous = null) {
        parent::__construct("Scheme error detected", $code, $previous);
        $this->errors = $errors;
    }

    public function getErrors() : array {
        return $this->errors;
    }
}