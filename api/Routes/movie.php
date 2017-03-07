<?php

/**
 * The variable '$movie_controller' creates a new object of the class 'MovieController';
 */
$movie_controller = new MovieController();

/**
 * Slim has routes to allow contact groups, this feature very helpful (therefore also very useful when working with Slim), when the need to repeat the same URL segments for multiple tracks.
 * Using the command: '$app->group("/movie", function() use ( $app, $movie_controller )', we turn to the variable $app (which actually contains all slim API), which operates the group (which is a feature of the slim), directs the group to "/movie" and activates a function that uses variables $app (which actually contains all slim API) and $movie_controller containing the new object of the class 'MovieController' generated.
 */
$app->group("/movie", function() use ( $app, $movie_controller ) {

    /**
     * Using the command: '$app->get("[/{movie_id}]", function( $request, $response, $params ) use ( $movie_controller, $app )', we turn to the variable $app (which actually contains the API slim), which performs application 'get' through the array and turns to '/{movie_id}' and activates a function that accepts parameters '$request, $response, $params' allows use variables '$app' (which actually contains all slim API) and '$movie_controller' containing the new object of the class 'MovieController' generated.
     */
    $app->get("[/{movie_id}]", function( $request, $response, $params ) use ( $movie_controller, $app ) {
        /**
         * Using the command: '$movie_id = intval( $params['movie_id'] );', we define the variable $movie_id, must have an integer value of the variable $params array of movie_id.
         */
        $movie_id = intval( $params['movie_id'] );

        /**
         * At this point, we're checking if the variable $movie_id contains a value that is not complete, we will print an error message stating that the "Movie ID must be integer".
         * We also take an array and transfer it to JSON using json_encode command and an error message will be displayed to us via an associative array.
         * And changing as '$movie_id', contains a value that is complete, we will review it, we will define the variable $movie examines the variable '@$movie_controller' which turns 'getMovie' function receives the variable '$movie_id' should contain an integer value.
         * If the '$movie' also contains a variable value which is not complete, turn the parameter '$response', he goes through a function that accepts numbers of error messages called 'WithStatus' (and in our case we would like to display an error message with the status code 404).
         */
        if ( !$movie_id )
            echo json_encode(["error" => "Movie ID must be integer"]);

        else {
            $movie = @$movie_controller->getMovie( $movie_id );
            if ( !$movie )
                $response->withStatus(404);
        }
    });

    /**
     * Using the command '$app->get("/search/{movie_title}", function( $request, $response, $params ) use ( $movie_controller )', we turn to the variable '$app' (which actually contains the API slim), which makes the get request when you search the movie title ('"/search/{movie_title}"') and activates a function that accepts parameters '$request, $response, $params' allows to use the variable '$movie_controller' containing the new object of class 'MovieController' created.
     */
    $app->get("/search/{movie_title}", function( $request, $response, $params ) use ( $movie_controller ) {
        /**
         * Using the command: '$movie_title = $params ['movie_title'];', we create a new variable named '$movie_title' get the '$params' parameter to the function that we have listed above and the array of 'movie_title'.
         */
        $movie_title = $params['movie_title'];

        /**
         * Now, we will try to catch an exception regarding exploration of search the movie using try & catch.
         * Using the command '$result = $movie_controller->searchMovieByName( $movie_title );', we create a new variable named '$result', which contains the variable '$movie_controller' which turns the function 'searchMovieByName' receives the variable '$movie_title' (containing the set of the movie title), and we'll do screen printing with variable we have created ('echo json_encode( $result );'), and as he was set, we'll use the command 'json_encode' which will transfer it to JSON.
         * Using the command: 'catch ( InvalidArgumentException $e )', we catch an exception if the variable '$e' is the wrong kind of argument, we'll print operation of the error message by running the getMessage function ('echo json_encode(["error" => $e->getMessage()]);'). As an the error found in the system we will use the command 'json_encode' which will take it to JSON.
         * Using the command: 'catch ( TypeError $e )', we catch an exception 'TypeError' type of the variable $e, we will print operation of the error message by running the getMessage function ('echo json_encode(["error" => $e->getMessage()]);'). As an the error found in the system we will use the command 'json_encode' which will take it to JSON.
         */
        try {
            $result = $movie_controller->searchMovieByName( $movie_title );
            echo json_encode( $result );
        } catch ( InvalidArgumentException $e ) {
            echo json_encode(["error" => $e->getMessage()]);
        } catch ( TypeError $e ) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    });

    /**
     * Using the command: '$app->post("", function( $request, $response, $params ) use ( $movie_controller, $app )', we turn to the variable '$app' (which actually contains the API slim), which performs post request and activates a function that accepts parameters '$request, $response, $params' and lets you use variables '$movie_controller' containing the new object of class 'MovieController' created and '$app' (which actually contains all slim API).
     */
    $app->post("", function( $request, $response, $params ) use ( $movie_controller, $app ) {
        /**
         * Using the command: '$movie = json_decode( $request->getBody() );', we create a new variable named '$movie', which takes JSON, and transfers it to the system using the command 'json_decode', parameter '$request' which turns the function 'getBody()'.
         */
        $movie = json_decode( $request->getBody() );

        /**
         * Now, we will try to catch an exception regarding the creation of a new film by using try & catch.
         * Using the command: 'echo $movie_controller->createNewMovie( $movie );', we will print operation of the variable '$movie_controller' which turns the function 'createNewMovie' and get your '$movie' he created a new variable above.
         * Using the class SchemaException we have built ('catch ( SchemaException $e )'), we will try to catch the variable '$e', and we'll print operation of variable function turns 'getErrors' which is a function we have built in-class SchemaException, which returns a Errors ('echo json_encode( $e->getErrors() );'). To show the array we use the 'json_encode' which takes the system and transfers it to JSON.
         * Using the command: 'catch ( TypeError $e )', we catch an exception TypeError type of the variable '$e', we will print operation error message saying that the structure of the JSON is not valid ('echo json_encode(["error" => "invalid json structure"]);'), because the error message is a command we use 'json_encode' and helped pass the array to JSON.
         */
        try {
            echo $movie_controller->createNewMovie( $movie );
        } catch ( SchemaException $e ) {
            echo json_encode( $e->getErrors() );
        } catch ( TypeError $e ) {
            echo json_encode(["error" => "invalid json structure"]);
        }

    });
});