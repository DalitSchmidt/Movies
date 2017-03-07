<?php

abstract class Controller {
    /**
     * @var
     * The '$model' and '$schema' fields define as 'protected', because we want to of class inherits the fields will have access to suitable and not be accessible to the fields outside of these classes.
     */
    protected $model;

    /**
     * @var \JsonSchema\Validator
     */
    protected $schema;

    /**
     * Controller constructor.
     * We will use the '__construct' function, because we want to be the new object certain features will be created.
     * We define the function as 'protected', because we want to of classes will inherit it appropriate access to them and they can not be accessed outside of these departments.
     * In this case, using the command: '$this->schema = new JsonSchema\Validator();', the '__construct' function builds a new object to 'JsonSchema\Validator();'. The new object is created by contacting the property $schema.
     */
    protected function __construct() {
        $this->schema = new JsonSchema\Validator();
    }
}