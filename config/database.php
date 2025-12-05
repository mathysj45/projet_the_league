<?php 
$host = "localhost";
$port = "3306";
$dbname = "the_league";
$connexionString = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8";

$user = "root";
$password = "demopma";

$db = new PDO(
    $connexionString,
    $user,
    $password
);

