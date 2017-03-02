<?php

require_once '../vendor/autoload.php';

require_once '../controller/MovieController.php';

$app = new Slim\App();

require_once 'Routes/movie.php';
require_once 'Routes/user.php';


$app->run();