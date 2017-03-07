<?php
/**
 * Definition 'namespace' for this class named 'Movies'.
 */
namespace Movies;

/**
 * Using the command: 'use PHPUnit\Framework\Exception;', we enable you the option of making exceptions.
 */
use PHPUnit\Framework\Exception;

/**
 * Create a class Movie
 * @package Movies
 */
class Movie {
    /**
     * @var string
     * The field '$movieName' accepts a string and set to private, because we don't want anyone using it will be able to change it.
     */
    private $movieName = '';
    /**
     * @var bool
     * The field '$details' accepts the condition boolean 'false' and set to private, because we don't want anyone using it will be able to change it.
     */
    private $details = false;
    /**
     * Using the command: 'const API_URL = 'http://www.omdbapi.com';', we specify the url constant (as defined permanent variable always will write it in capital letters).
     */
    const API_URL = 'http://www.omdbapi.com';
    /**
     * Using the command: 'const DATA_FOLDER = 'data';', we set the folder directory 'data' is fixed and folder which will be fixed all the information from the data (as defined permanent variable always will write it in capital letters).
     */
    const DATA_FOLDER = 'data';

    /**
     * Movie constructor.
     * @param string $movieName
     * The constructor function gets the $movieName of parameter (a string) and is where the movie turns into newly created reference: "$this->setMovieName( $movieName );"
     */
    public function __construct( string $movieName ) {
        $this->setMovieName( $movieName );
    }

    /**
     * @return mixed
     * The method 'getDetails() : mixed' returns the details of the newly created object using the command: 'return $this->details;'.
     */
    public function getDetails() : mixed {
        return $this->details;
    }

    /**
     * @param string $movieName
     * The function 'setMovieName' allows to setter the name of the movie ('string $movieName'), by calling for the newly created movie with the command: '$this->movieName = $movieName;'.
     */
    public function setMovieName( string $movieName ) {
        /**
         * If there is a $movieName short than 3 characters, the function will throw us a message saying: "Movie must be at least 3 letters".
         */
        if ( strlen( $movieName < 3 ) )
            throw new Exception("Movie must be at least 3 letters");

        $this->movieName = $movieName;
    }

    /**
     * @return string
     * The function 'getMovieName' allows to get the name (string) of the new movie created by the return of the name by the command: 'return $this->movieName;'.
     */
    public function getMovieName() : string {
        return $this->movieName;
    }

    /**
     * @return bool
     * The method 'searchMovieInOMDB()' returns boolean.
     * The method 'searchMovieInOMDB()' allows us to search the Movie in a web omdb
     */
    private function searchMovieInOMDB() : boolean {
        /**
         * The variable '$data', make an appeal simulating AJAX request to url, using the command: '@file_get_contents(self::API_URL . '/?t=' . $this->movieName . '&y=&plot=short&r=json');'.
         * Using the command: 'file_get_contents' allows you to make the AJAX request, we silenced with the command '@', that we are not interested in jumping us Error message or Warning message.
         * Using the command: 'self::API_URL' we turn directly to API_URL defined as set forth at the beginning of the class.
         * Using the command: '$this->MovieName', we turn directly to the object of the newly created '$MovieName' (actually created for the new Movie).
         */
        $data = @file_get_contents(self::API_URL . '/?t=' . $this->movieName . '&y=&plot=short&r=json');

        /**
         * Using the command: 'if ( !$data )', we are checking if it is not changing data, then the boolean value 'false' is returned
         */
        if ( !$data )
            return false;

        /**
         * Using the command: '$data = json_decode( $data, true );', we take JSON and move it into the '$data' array that returns the boolean value to 'true'.
         */
        $data = json_decode( $data, true );

        /**
         * Using the command: 'if ($data ['Response'] == 'false')', we perform testing if '$data' is an array responsive compared to false, then the boolean value 'false' is returned.
         */
        if ( $data['Response'] == 'False' )
            return false;

        /**
         * Using the command: '$this->details = $ data ;', we turn to the newly created object 'details' and entering array '($data)', and return the boolean value to 'true'.
         */
        $this->details = $data;
        return true;
    }

    /**
     * @return bool
     * The method 'searchMovieInDB()' returns boolean.
     * The method 'searchMovieInDB()' allows us to search the Movie in a Database.
     */
    private function searchMovieInDB() : bool {
        /**
         * Using the command: '$name = strtolower( $this->movieName );', any newly created movie name converted to lowercase.
         */
        $name = strtolower( $this->movieName );
        /**
         * The variable '$movie', make an appeal simulating AJAX request to url, using the command: '@file_get_contents(self::DATA_FOLDER . '/' . $name . '.json');'.
         * Using the command: 'file_get_contents' allows you to make the AJAX request, we silenced with the command '@', that we are not interested in jumping us Error message or Warning message.
         * Using the command: 'self::DATA_FOLDER' we turn directly to DATA_FOLDER defined as set forth at the beginning of the class.
         * Using the command: '$name', we turn directly to a variable defined over which converts any new movie name to lowercase.
         */
        $movie = @file_get_contents(self::DATA_FOLDER . '/' . $name . '.json');

        /**
         * Using the command: 'if ( !$movie )', we are checking if it is not changing movie, then the boolean value 'false' is returned.
         */
        if ( !$movie )
            return false;

        /**
         * Using the command: '$this->details = json_decode( $movie, true );', each new object is created in the details get JSON and puts it into the array of '$movie' and get the boolean value to 'true', eventually will be returned to us boolean value to 'true'.
         */
        $this->details = json_decode( $movie, true );
        return true;
    }

    /**
     * @param string $searchIn
     * @return mixed;
     * The 'search' function ('search( $searchIn = 'both' ) : mixed') allows us to search databases are the repository of OMDB and at in DataBase.
     */
    public function search( $searchIn = 'both' ) : mixed {
        /**
         * Using the command: 'if ( $searchIn == 'api' )', if the movie is when you search on OMDB, with the command: 'if ( $this->searchMovieInOMDB() )', will be returned to us his name from OMDB, with the command: 'return $this->details;'.
         */
        if ( $searchIn == 'api' )
            if ( $this->searchMovieInOMDB() )
                return $this->details;

        /**
         * Using the command: 'elseif ( $searchIn == 'db' )', if the movie is when you search on DataBase, with the command: 'if ( $this->searchMovieInDB() )' and will be returned to us his name from DataBase with the command: 'return $this->details;'.
         */
        elseif ( $searchIn == 'db' )
            if ( $this->searchMovieInDB() )
                return $this->details;

        else {
            /**
             * Using the command: 'if ( !$this->searchMovieInOMDB() )', if the movie is not found during the search in OMDB.
             */
            if ( !$this->searchMovieInOMDB() ) {
                /**
                 * Using the command: 'if ( $this->searchMovieInDB() )', if the movie is not found during the search in DataBase and returns each new object is created in the details with the command: 'return $this->details;'.
                 */
                if ( $this->searchMovieInDB() ) {
                    return $this->details;
                /**
                 * else returns the boolean 'false'.
                 */
                } else {
                    return false;
                }
            /**
             * else returns each new object is created in the details with the command: 'return $this->details;'.
             */
            } else {
                return $this->details;
            }
        }
        /**
         * @return bool (false)
         */
        return false;
    }
}

/**
 * The variable '$m', creates a new object of the class 'Movie', in this case a new object is created in the name of a movie called 'Django'.
 */
$m = new Movie('Django');
/**
 * The newly created object runs the method 'search()' using the command: '$m->search();'.
 * This command actually performs the search of the name of the movie.
 */
$m->search();