<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once '../model/MovieModel.php';

class MovieController extends Controller {
    public function __construct() {
        parent::__construct();
        $this->model = new MovieModel();
    }

    public function searchMovieByName( string $movie_name ) {
        if ( strlen( $movie_name ) < 3 )
            throw new InvalidArgumentException("Movie name must be at least 3 letters");

        return $this->model->searchMovieByName( $movie_name );
    }

    public function getMovie( int $movie_id ) {
        return $this->model->getMovie( $movie_id );
    }

    public function createNewMovie( object $args ) {
        $this->schema->check( $args, json_decode( file_get_contents('schemas/movie.json') ) );

        if ( !$this->schema->isValid() ) {
            $errors = [];

            foreach ( $this->schema->getErrors() as $error )
                $errors[ $error['property'] ] = $error['message'];

            throw new SchemaException( $errors );
        }

        $this->model->createNewMovie( $args );
    }
}

$c = new MovieController();