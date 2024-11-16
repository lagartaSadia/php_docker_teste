<?php

if(!isset($_SESSION)) {
  session_start();
}

if(!isset($_SESSION['id'])) {
  die("Você não pode acessar a página, enquanto não estiver logado! <p><a href=\"login.php\">Logar</a></p>");
}