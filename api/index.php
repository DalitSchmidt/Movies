<?php
require '../vendor/autoload.php';
$app = new Slim\App();

use Movies\Movie as Movie;

$app->group('/movie', function() use ( $app ) {
    $app->get('[/{title}]', function( $request, $response, $params ) {
        $title = $params['title'];
        $m = new Movie( $title );
        var_dump( $m->search('api') );
    });
});

$app->run();