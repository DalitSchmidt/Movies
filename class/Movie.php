<?php
namespace Movies;

class Movie {
    private $movieName = '';
    private $details = false;
    const API_URL = 'http://www.omdbapi.com';
    const DATA_FOLDER = 'data';

    /**
     * Movie constructor.
     * @param string $movieName
     * The constructor function gets the $movieName of parameter (a string) and is
     * where the movie turns into newly created reference: "$this->setMovieName( $movieName );"
     */
    public function __construct( string $movieName ) {
        $this->setMovieName( $movieName );
    }

    public function getDetails() : mixed {
        return $this->details;
    }

    /**
     * @param string $movieName
     * The function 'setMovieName' allows to setter the name of the movie,
     * by calling for the newly created movie with
     * the command: "$this->movieName = $movieName;"
     */
    public function setMovieName( string $movieName ) {
        // If there is a $movieName short than 3 characters, the function will throw us a message saying: "Movie must be at least 3 letters".
        if ( strlen( $movieName < 3 ) )
            throw new Exception("Movie must be at least 3 letters");

        $this->movieName = $movieName;
    }

    /**
     * @return string
     * The function 'getMovieName' allows to get the name (string) of
     * the new movie created by the return of the
     * name by the command: "return $this->movieName;".
     */
    public function getMovieName() : string {
        return $this->movieName;
    }

    /**
     * @return bool
     */
    private function searchMovieInOMDB() : boolean {
        $data = @file_get_contents(self::API_URL . '/?t=' . $this->movieName . '&y=&plot=short&r=json');

        if ( !$data )
            return false;

        $data = json_decode( $data, true );

        if ( $data['Response'] == 'False' )
            return false;

        $this->details = $data;
        return true;
    }

    /**
     * @return bool
     */
    private function searchMovieInDB() {
        $name = strtolower( $this->movieName );
        $movie = @file_get_contents(self::DATA_FOLDER . '/' . $name . '.json');

        if ( !$movie )
            return false;

        $this->details = json_decode( $movie, true );
        return true;
    }

    /**
     * @param string $searchIn
     * The search function allows us to search databases are the repository of OMDB and at in DataBase
     * @return mixed;
     */
    public function search( $searchIn = 'both' ) : mixed {
        // If the movie is when you search on OMDB, will be returned to us his name from OMDB
        if ( $searchIn == 'api' )
            if ( $this->searchMovieInOMDB() )
                return $this->details;

        // If the movie is when you search on DataBase, will be returned to us his name from DataBase
        elseif ( $searchIn == 'db' )
            if ( $this->searchMovieInDB() )
                return $this->details;

        // If the movie is not found during the search in OMDB, will perform a search in the DataBase and bring us from DataBase
        else {
            if ( !$this->searchMovieInOMDB() ) {
                if ( $this->searchMovieInDB() ) {
                    return $this->details;
                } else {
                    return false;
                }
            } else {
                return $this->details;
            }
        }

        return false;
    }
}

$m = new Movie('Django');
$m->search();