
<?php

require "config/autoload.php";
define('BASE_URL', '/projet_the_league'); // <-- A adapter par chaque développeur !
$router = new Router();
$router->handleRequest($_GET);
$TeamManager = new TeamManager();

require 'controllers/AbstractController.php';
?>