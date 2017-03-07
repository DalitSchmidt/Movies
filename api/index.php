<?php

/**
 * Connection file autoload.php to index file, using the command: 'require_once '../vendor/autoload.php';', basically it allows us to get all the features of baskets and work with it properly.
 **/
require_once '../vendor/autoload.php';

/**
 * Connection file MovieController.php to index file, using the command: 'require_once '../controller/MovieController.php';'.
 */
require_once '../controller/MovieController.php';

/**
 * $app create a new object of Slim with the command: '$app = new Slim\App();'
 **/
$app = new Slim\App();

/**
 * Connection file movie.php to index file, using the command: 'require_once 'Routes/movie.php';'.
 */
require_once 'Routes/movie.php';
/**
 * Connection file user.php to index file, using the command: 'require_once 'Routes/user.php';'.
 */
require_once 'Routes/user.php';

/**
 * Through prompt '$app->run();' we operate the new object of Slim generated (actually, we cause any code to run ...)
 **/
$app->run();