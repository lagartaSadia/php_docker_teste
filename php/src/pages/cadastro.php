<?php

include('../config/conexao.php');

if (isset($_POST['email']) || isset($_POST['senha'])) {
  if (strlen($_POST['name']) == 0) {
    echo "Preencha o nome";
  } else if (strlen($_POST['email']) == 0) {
    echo "Preencha o e-mail";
  } else if (strlen($_POST['senha']) == 0) {
    echo "Preencha a senha";
  } else {
    $nome = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sql_code = "SELECT * FROM usuarios WHERE email='$email'";
    $sql_query = $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);

    $quantidade = $sql_query->num_rows;

    if ($quantidade == 0) {
      $sql_code = "INSERT INTO usuarios(nome, email, senha) VALUES('$nome', '$email', '$senha')";
      $conn->query($sql_code) or die("Falha na execução do código SQL: " . $conn->error);
      $usuario = $sql_query->fetch_assoc();

      if (!isset($_SESSION)) {
        session_start();
      }

      $_SESSION['id'] = $usuario['id'];
      $_SESSION['nome'] = $usuario['nome'];

      header('Location: painel.php');
    } else {
      echo "Falha ao cadastrar! E-mail já cadastrado.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>cadastro</title>
</head>

<body>
  <?php include('../partials/navbar.php') ?>
  <form action="" method="post">
    <label for="name">Nome</label>
    <input type="text" name="name" id="name">
    <label for="email">E-mail</label>
    <input type="email" name="email" id="email">
    <label for="senha">Senha</label>
    <input type="password" name="senha" id="senha">
    <button type="submit">Cadastrar</button>
  </form>

</body>

</html>