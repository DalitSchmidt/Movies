<?php

abstract class Model {
    /**
     * @var mysqli
     * The field '$db' that contains all the data in the database, we define as protected, because we want to of- class inherits the field have access to appropriate and can not be accessed outside the field of those departments.
     * We will use the '__construct' function, because we want the new object certain features will be created.
     * We define the function as 'public', because we want to have access to the outside of class.
     * In this case, using the command: '$this->db = new mysqli("localhost", "root", "", "movies");', the new object field would be formed '$db' turn, creates new mysqli query that brings all the answers from the database 'movies.
     */
    protected $db;

    public function __construct() {
        $this->db = new mysqli("localhost", "root", "", "movies");
    }
}