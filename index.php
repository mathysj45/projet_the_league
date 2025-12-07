
<?php

<<<<<<< HEAD
require "config/autoload.php";
define('BASE_URL', '/projet_the_league'); // <-- A adapter par chaque développeur !
$router = new Router();
$router->handleRequest($_GET);
$TeamManager = new TeamManager();

require 'controllers/AbstractController.php';
=======
require "config/autoload.php"; 

define('BASE_URL', '/cour-php-coda/projet_the_league');

$router = new Router();
$router->handleRequest($_GET);

$TeamManager = new TeamManager(); 

>>>>>>> 291d9fab6ec3f4bcb1cffdc6a3f16c1937d939ea
?>