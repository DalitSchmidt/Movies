<?php

use PHPUnit\Framework\TestCase;

class MovieTest extends TestCase {
    public function testSetMovieName() {
        $movie = new \Movies\Movie('');
        $this->expectException( $movie );
    }

    public function testSearchingAMovieInOMDBAPI() {
        $movie = new \Movies\Movie('Django');
        $movie->search('api');
        $this->assertType('array', $movie->getDetails());
    }
}