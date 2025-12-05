<?php

require "config/autoload.php";

$router = new Router();
$router->handleRequest($_GET);

$truc = new Team(1,"bob","un tuc","jcp");
echo $truc->getName();