<?php

/**
 * Connection file autoload.php to index file, using the command: 'require_once __DIR__ . '/../vendor/autoload.php';', basically it allows us to get all the features of baskets and work with it properly.
 */
require __DIR__ . '/../vendor/autoload.php';

/**
 * Using the command: '$data = json_decode(file_get_contents('data.json'));', the variable $data calls to file data.json and taking away the data and puts them within the array.
 */
$data = json_decode(file_get_contents('data.json'));

/**
 * Validate
 * Using the command: '$validator = new JsonSchema\Validator();', the variable '$validator' create an "instance" of a new class 'Validator' is connected to JsonSchema.
 * Using the command: '$validator->check( $data, (object) json_decode(file_get_contents('schema.json')) );', the variable '$validator' (with which we have created an "instance" of a new 'Validator' class), addressing feature check and help make the validation data in the variable '$data', and takes the data from the file 'schema.json' and transfers them to the array. That is, at this stage, is examined that the data file 'schema.json' are hands - appropriate fields defined in the file.
 */
$validator = new JsonSchema\Validator();
$validator->check( $data, (object) json_decode(file_get_contents('schema.json')) );

/**
 * At this point, we perform testing for the errors with which we present as there are errors.
 * Using the command: 'if ($validator->isValid()) {
echo "The supplied JSON validates against the schema.\n";
}', we check if the variable '$validator' is over, as far as the variable '$validator' and over, we will print a message saying that 'The supplied JSON validates against the schema'.
 * The next phase of testing we use the command: 'else {
$errors = [];
foreach ($validator->getErrors() as $error) {
$errors[ $error['property'] ] = $error['message'];
}
echo json_encode( $errors );
}', so far as the test was not successful and we will be presented with the error message through the network, because we set the variable '$errors' array.
 * Using foreach loop we go through the system and find errors, and finally print them to the screen after we pass the '$errors' array to JSON.
 */
if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    $errors = [];
    foreach ($validator->getErrors() as $error) {
       $errors[ $error['property'] ] = $error['message'];
    }
    echo json_encode( $errors );
}