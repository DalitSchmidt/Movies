<?php
require_once 'Model.php';

class MovieModel extends Model
{
    public function getAllMovies()
    {
        return $this->db->query("SELECT * FROM movies");
    }

    public function deleteMovie(int $movie_id)
    {
        $this->db->query("DELETE FROM movies WHERE movie_id = $movie_id");

        return $this->db->affected_rows;
    }

    public function getMovie(int $movie_id)
    {
        return $this->db->query("SELECT * FROM movies WHERE movie_id = $movie_id");
    }

    public function searchMovieByName(string $movie_name)
    {
        return $this->db->query("SELECT * FROM movies WHERE movie_name LIKE '%$movie_name%'");
    }

    public function updateMovie(int $movie_id, array $args)
    {

    }

    public function createNewMovie( object $args ) {

    }
}