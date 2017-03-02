<?php
require __DIR__ . '/../vendor/autoload.php';

$data = json_decode(file_get_contents('data.json'));

$validator = new JsonSchema\Validator();
$validator->check($data, (object) json_decode(file_get_contents('schema.json')));

if ($validator->isValid()) {
    echo "The supplied JSON validates against the schema.\n";
} else {
    $errors = [];
    foreach ($validator->getErrors() as $error) {
       $errors[ $error['property'] ] = $error['message'];
    }
    echo json_encode($errors);
}