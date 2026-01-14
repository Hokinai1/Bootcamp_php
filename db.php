<?php

$host = "localhost";
$dbname = "php_db";
$username = "root";
$password = "";

try {

$pdo = new PDO("mysql:host=$host;dbname=$dbname;", $username, $password);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// echo"Connexion réussi";
}catch(PDOException $e){

 echo"Echec". $e->getMessage();


}
?>