
<?php

require "config/autoload.php"; 

define('BASE_URL', '/cour-php-coda/projet_the_league');

$router = new Router();
$router->handleRequest($_GET);

$TeamManager = new TeamManager(); 

?>