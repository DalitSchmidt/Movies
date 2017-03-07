<?php

/**
 * Connection file autoload.php to index file, using the command: 'require_once __DIR__ . '../vendor/autoload.php';', basically it allows us to get all the features of baskets and work with it properly.
 */
require_once __DIR__ . '/../vendor/autoload.php';
/**
 * Connection file 'MovieModel.php' to index file, using the command: 'require_once '../model/MovieModel.php';'.
 */
require_once '../model/MovieModel.php';

/**
 * Class MovieController
 * The class 'MovieController' inherits from class 'Controller'.
 */
class MovieController extends Controller {
    /**
     * MovieController constructor.
     * We will use the '__construct' function, because we want the new object certain features will be created.
     * In this case we define the function as 'public', because we want to have access to the outside of class.
     * We use the command: 'parent::__construct();', because we want the '__construct' function in the current class will inherit the '__construct' function features that in her parent class (in this case from the class 'Controller').
     * Using the command: '$this->model = new MovieModel();', we want the function to create a new object of the class 'MovieModel', and it does so by contacting the field object model would be created.
     */
    public function __construct() {
        parent::__construct();
        $this->model = new MovieModel();
    }

    /**
     * @param string $movie_name
     * @return bool|mysqli_result
     * With the function 'searchMovieByName', we can search the movie title.
     * The function we define as public, because we want to have access to the outside of class.
     * The function receives the parameter '$movie_name,' it must be of type string.
     * In order to receive in the function parameter string, we perform testing using the command: 'if ( strlen( $movie_name ) < 3 )', during which an InvalidArgumentException is thrown, saying that if the length of the letters of the name of the movie has fewer than 3 letters, then be thrown an error message: 'Movie name must be at least 3 letters'.
     * Using the command: 'return $this->model->searchMovieByName( $movie_name );', the function return the new object would be created from the class cleared the field model and turns 'searchMovieByName' function receives the parameter '$movie_name'. So in practice, the function returns a boolean or mysql query result, that is ultimately the function returns the name of the movie has entered into a search.
     */
    public function searchMovieByName( string $movie_name ) {
        if ( strlen( $movie_name ) < 3 )
            throw new InvalidArgumentException("Movie name must be at least 3 letters");

        return $this->model->searchMovieByName( $movie_name );
    }

    /**
     * @param int $movie_id
     * @return bool|mysqli_result
     * With the function 'getMovie', we get the movie by id.
     * The function we define as public, because we want to have access to the outside of class.
     * The function receives the parameter '$movie_id', it must be of type int.
     * Using the command: 'return $this->model->getMovie( $movie_id );', the function returns the new object would be created from the class cleared the field model and turns 'getMovie' function receives the parameter '$movie_id'. So in practice, the function returns a boolean or mysql query result, that is ultimately the function returns the movie by id.
     */
    public function getMovie( int $movie_id ) {
        return $this->model->getMovie( $movie_id );
    }

    /**
     * @param object $args
     * @throws SchemaException
     * With the function 'createNewMovie', we create a new movie.
     * The function we define as public, because we want to have access to the outside of class.
     * The function receives the '$args' parameter, which must be of type object. '$args' parameter should contain all the details of the movie.
     * Using the command: '$this->schema->check( $args, json_decode( file_get_contents('schemas/movie.json') ) );', the new object would be created from the class, the field turns addressing schema and field check function (which is a function executive validation and built-in JsonSchema). Check function receives the '$args' parameter, and takes the data inside the file 'movie.json' (located under the folder schemas) after reading the file using the command 'file_get_contents', it transfers the data available in the array.
     * Using the command: 'if ( !$this->schema->isValid() )', we're checking if the new object would be created from the class cleared the field and schema is not over, we get the errors by value by setting the variable errors.
     * Using the command: 'foreach ( $this->schema->getErrors() as $error ) $errors[ $error['property'] ] = $error['message'];', we're checking if there is an error, and as there is an error, the error message
    A detailed displayed when an SchemaException be thrown (which we have built class) that contains the error with the command: 'throw new SchemaException( $errors );'.
     * We pass the array using foreach loop because it moves the system and taking "organ".
     * Using the command: '$this->model->createNewMovie( $args );', the new object would be created addressing field model which activates the function 'createNewMovie', which receives '$args' parameter.
     */
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

/**
 * The variable '$c' create an new "instance" of the class 'MovieController();'.
 */
$c = new MovieController();