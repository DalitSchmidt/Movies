<?php

/**
 * In this file we perform tests for Class 'Movie', and basically any file which is also performing tests of class
 * With the command 'use PHPUnit\Framework\TestCase;', allows us to run the tests that exist in the framework and only called PHP Unit
 */
use PHPUnit\Framework\TestCase;

/**
 * Class MovieTest
 * The class 'MovieTest' extends from TestCase
 */
class MovieTest extends TestCase {
    /**
     * The method 'TestSetMovieName', checks the value of the name of the movie
     * The command: '$movie = new \Movies\Movie('');', creates a new object of a movie name
     * The command: '$this->expectException( $movie );', check the name of the newly created movie
     */
    public function testSetMovieName() {
        $movie = new \Movies\Movie('');
        $this->expectException( $movie );
    }

    /**
     * The method 'TestSearchingAMovieInOMDBAPI', checks the database OMDB movie name and API
     * The command: '$movie = new \Movies\Movie('Django');', creates a new object of a movie title
     * (in this case the test creates a new object of a movie called 'Django').
     * The Command: '$movie->search('api');' performs a search of where the movie generated in api
     * With the command: '$this->assertType('array', $movie->getDetails());', we're checking whether
     * '$movie->getDetails()' is array
     */
    public function testSearchingAMovieInOMDBAPI() {
        $movie = new \Movies\Movie('Django');
        $movie->search('api');
        $this->assertType('array', $movie->getDetails());
    }
}