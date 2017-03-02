<?php

abstract class Controller {
    protected $model;

    protected $schema;

    protected function __construct() {
        $this->schema = new JsonSchema\Validator();
    }
}