<?php

/**
 * In this file we perform tests for Class 'Movie', and basically any file which is also performing tests of class.
 * Using the command 'use PHPUnit\Framework\TestCase;', allows us to run the tests that exist in the framework and only called PHP Unit.
 */
use PHPUnit\Framework\TestCase;

/**
 * Class MovieTest
 * The class 'MovieTest' extends from TestCase.
 */
class MovieTest extends TestCase {
    /**
     * The function (method) 'TestSetMovieName', checks the value of the name of the movie.
     * Using the command: '$movie = new \Movies\Movie('');', creates a new object of a movie name.
     * Using the command: '$this->expectException( $movie );', check the name of the newly created movie.
     */
    public function testSetMovieName() {
        $movie = new \Movies\Movie('');
        $this->expectException( $movie );
    }

    /**
     * The function (method) 'TestSearchingAMovieInOMDBAPI', checks the database OMDB movie name and API.
     * Using the command: '$movie = new \Movies\Movie('Django');', creates a new object of a movie title (in this case the test creates a new object of a movie called 'Django').
     * Using the command: '$movie->search('api');' performs a search of where the movie generated in api.
     * Using the command: '$this->assertType('array', $movie->getDetails());', we're checking whether $movie->getDetails()' is array.
     */
    public function testSearchingAMovieInOMDBAPI() {
        $movie = new \Movies\Movie('Django');
        $movie->search('api');
        $this->assertType('array', $movie->getDetails());
    }
}