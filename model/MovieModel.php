<?php

/**
 * Connection file 'Model.php' to index file, using the command: 'require_once 'Model.php';'.
 */
require_once 'Model.php';

/**
 * Class MovieModel
 * The class 'MovieModel' inherits from class 'Model'.
 * All the methods (functions) in this class, we define as 'public', because we want to be accessed outside of class.
 * In this class, we perform the CRUD operations so that we create the database 'movies' using the following steps: Create, Read, Update and Delete.
 */
class MovieModel extends Model
{
    /**
     * @return bool|mysqli_result
     * The function 'getAllMovies', returns all data are in the database 'movies', using the command 'return $this->db->query("SELECT * FROM movies");'.
     */
    public function getAllMovies()
    {
        return $this->db->query("SELECT * FROM movies");
    }

    /**
     * @param int $movie_id
     * @return int
     * The function 'deleteMovie' allows us to erase the tape by its id.
     * The function receives as a parameter the variable '$movie_id' and must be an 'int'.
     * Delete the movie by its id query execution is enabled through: '$this->db->query("DELETE FROM movies WHERE movie_id = $movie_id");' to database 'movies'.
     * Using the command: 'return $this->db->affected_rows;', the function returns the variable 'affected_rows' (it varies a built-in mysql) must be of type int.
     */
    public function deleteMovie(int $movie_id)
    {
        $this->db->query("DELETE FROM movies WHERE movie_id = $movie_id");

        return $this->db->affected_rows;
    }

    /**
     * @param int $movie_id
     * @return bool|mysqli_result
     * The function 'getMovie' allows us to get the movie under its id must be of type int.
     * In order to allow us to get the movie under its id, the function returns the movie with the query: 'return $this->db->query("SELECT * FROM movies WHERE movie_id = $movie_id");'.
     */
    public function getMovie(int $movie_id)
    {
        return $this->db->query("SELECT * FROM movies WHERE movie_id = $movie_id");
    }

    /**
     * @param string $movie_name
     * @return bool|mysqli_result
     * The function 'searchMovieByName' allows us to search by name of the movie in the database must be a string.
     * Using the command: 'return $this->db->query("SELECT * FROM movies WHERE movie_name LIKE '%$movie_name%'");', the function that searches in the database 'movies' and returns the search results in accordance with the pattern.
     */
    public function searchMovieByName(string $movie_name)
    {
        return $this->db->query("SELECT * FROM movies WHERE movie_name LIKE '%$movie_name%'");
    }

    /**
     * @param int $movie_id
     * @param array $args
     * The function 'updateMovie', allows us to update the data in the movie by his id, so the function accepts two parameters, each '$movie_id' must be of type int and the other '$args' must be an array containing all the details of the movie.
     */
    public function updateMovie(int $movie_id, array $args)
    {

    }

    /**
     * @param object $args
     * The function 'createNewMovie', allows us to create a new movie, so the function gets the '$args' parameter must be an object that contains all the details of the new movie.
     */
    public function createNewMovie( object $args ) {

    }
}