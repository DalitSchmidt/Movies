<?php
$movie_controller = new MovieController();

$app->group("/movie", function() use ( $app, $movie_controller ) {

    $app->get("[/{movie_id}]", function( $request, $response, $params ) use ( $movie_controller, $app ) {
        $movie_id = intval( $params['movie_id'] );

        if ( !$movie_id )
            echo json_encode(["error" => "Movie ID must be integer"]);

        else {
            $movie = @$movie_controller->getMovie($movie_id);
            if ( !$movie )
                $response->withStatus(404);
        }
    });

    $app->get("/search/{movie_title}", function( $request, $response, $params ) use ( $movie_controller ) {
        $movie_title = $params['movie_title'];

        try {
            $result = $movie_controller->searchMovieByName( $movie_title );
            echo json_encode( $result );
        } catch ( InvalidArgumentException $e ) {
            echo json_encode(["error" => $e->getMessage()]);
        } catch ( TypeError $e ) {
            echo json_encode(["error" => $e->getMessage()]);
        }
    });

    $app->post("", function( $request, $response, $params ) use ( $movie_controller, $app ) {
        $movie = json_decode( $request->getBody() );
        try {
            echo $movie_controller->createNewMovie( $movie );
        } catch ( SchemaException $e ) {
            echo json_encode( $e->getErrors() );
        } catch ( TypeError $e ) {
            echo json_encode(["error" => "invalid json structure"]);
        }

    });
});
