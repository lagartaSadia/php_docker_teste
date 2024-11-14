<?php

include('../config/conexao.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {
  if (strlen($_POST['email']) == 0) {
    echo "Preencha o e-mail";
  } else if (strlen($_POST['senha']) == 0) {
    echo "Preencha a senha";
  } else {
    $email = $conn->real_escape_string($_POST['email']);
    $senha = $conn->real_escape_string($_POST['senha']);

    $sql_code = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
    $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 1) {
      $usuario = $sql_query->fetch_assoc();

      if (!isset($_SESSION)) {
        session_start();
      }

      $_SESSION['id'] = $usuario['id'];
      $_SESSION['nome'] = $usuario['nome'];

      header('Location: painel.php');
    } else {
      echo "Falha ao logar! E-mail ou senha incorretos.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
</head>

<body>
  <?php include('../partials/navbar.php') ?>
  <form action="" method="post">
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email">
    <label for="senha">E-mail</label>
    <input type="password" name="senha" id="senha">
    <button type="submit">Logar</button>
  </form>
</body>

</html>