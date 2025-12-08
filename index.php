
<?php

require "vendor/autoload.php";
define('BASE_URL', '/exercice_Php/J1-BPH/projet_the_league/'); // <-- A adapter par chaque développeur !
$router = new Router();
$router->handleRequest($_GET);
$TeamManager = new TeamManager();

?>