<?php

/**
 * Class SchemaException
 * * The class 'SchemaException' inherits from class 'Exception'.
 */
class SchemaException extends Exception {
    /**
     * @var array
     * The variable '$errors' contains array any errors it contains.
     * The variable '$errors' we define as private because we would like to have access to the system outside of class.
     */
    private $errors = [];

    /**
     * SchemaException constructor.
     * @param array $errors
     * @param int $code
     * @param Exception|null $previous
     * We will use the constructor function, because we want the new object certain features will be created.
     * In this case we define the function as 'public', because we want to have access to the outside of class.
     * In this case, the '__construct' function accepts the values​of: 'array $errors, $code = 0, Exception $previous = null', these values constitute the features of the new object will be created and configured is fixed.
     * We use the command: 'parent::__construct( "Scheme error detected", $code, $previous );', because we want the '__construct' function in the current class will inherit the '__construct' function features that in her parent class (in this case from class Exception). In addition to function accepts the values '$code' and '$previous', we defined it above.
     * Using the command: '$this->errors = $errors;', the new object would be created addressing attribute errors get the system of errors.
     */
    public function __construct( array $errors, $code = 0, Exception $previous = null ) {
        parent::__construct( "Scheme error detected", $code, $previous );
        $this->errors = $errors;
    }

    /**
     * @return array
     * The function 'getErrors' accepts the existing errors which must be an array and returns them using the command 'return $this->errors;'.
     * The function we define as 'public', because we want to have access to the outside of class.
     */
    public function getErrors() : array {
        return $this->errors;
    }
}