<?php

$host = "db";
$user = "user";
$pass = "user_pass";
$database = "MY_DATABASE";
$port = "3306";

$conn = new mysqli($host, $user, $pass, $database, $port);

if ($conn->error) {
  die("Falha ao conectar com a base de dados: " . $conn->error);
}
