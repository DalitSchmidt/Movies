<?php

/**
 * Connecting the index file, the command is carried out using 'require '../vendor/autoload.php';', actually This allows us to get all the features of Slim to work with it properly
 **/
require '../vendor/autoload.php';

/**
 * $app create a new object of Slim with the command: '$app = new Slim\App();'
 **/
$app = new Slim\App();

/**
 * Using the command 'use Movies\Movie as Movie;', we allow to 'Movies\Movie' be as that 'Movie' (which is defined via the namespace). In fact, we turn to a file 'Movie.php' and run it.
 */
use Movies\Movie as Movie;

/**
 * Slim has routes to allow contact groups, this feature very helpful (therefore also very useful when working with Slim), when the need to repeat the same URL segments for multiple tracks.
 * In this case, we turn to the group: '/movie'
 * We use the command 'function () use ($ app)', to use the features of Slim
 **/
$app->group('/movie', function() use ( $app ) {
    /**
     * Using the command '$app->get', we let get through slim (which is actually $app), the title (''[/{title}]'') and we'll present in a function that accepts parameters '$request, $response, $params'.
     */
    $app->get('[/{title}]', function( $request, $response, $params ) {
        /**
         * Using the command '$title = $params['title'];', we bring with the array parameter of the title
         */
        $title = $params['title'];
        /**
         * Using the command '$m = new Movie( $title );', we create a new object from the class Movie get the system of title (which is actually now command $title).
         */
        $m = new Movie( $title );
        /**
         * Using the command 'var_dump( $m->search('api') );', we're checking whether the new object created a search in 'api'.
         */
        var_dump( $m->search('api') );
    });
});

/**
 * Through prompt '$app->run();' we operate the new object of Slim generated (actually, we cause any code to run ...)
 **/
$app->run();