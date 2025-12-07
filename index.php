<?php

require "config/autoload.php";
$router = new Router();
$router->handleRequest($_GET);
$TeamManager = new TeamManager();

define('BASE_URL', '/cour-php-coda/projet_the_league'); // <-- A adapter par chaque développeur !
require 'controllers/AbstractController.php';
?>