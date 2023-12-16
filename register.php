<?php
require_once "connection.php";
require_once "utils.php";
session_start();
$username = $password = $confirm_password = $username_err = $password_err = $confirm_password_err = "";
if (isset($_POST["submit"])) {
        if (empty(trim($_POST["username"]))) {
            $username_err = "Por favor, insira um nome de usuário.";
        } else {
            $username = trim($_POST["username"]);
        }
        if (empty(trim($_POST["password"]))) {
            $password_err = "Por favor, insira uma senha.";
        } else {
            $password = trim($_POST["password"]);
        }
        if (empty(trim($_POST["confirm_password"]))) {
            $confirm_password_err = "Por favor, confirme a senha.";
        } else {
            $confirm_password = trim($_POST["confirm_password"]);
            if (empty($password_err) && ($password != $confirm_password)) {
                $confirm_password_err = "As senhas não conferem.";
            }
        }
        if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
            if (createUser($username, $password)) {
                header("location: login.php");
            } else {
                echo "<div class='alert alert-danger' role='alert'>Erro ao criar usuário</div>";
            }
        }
}

// check if user is already logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

?>

<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <script src="bootstrap/js/bootstrap.js"></script>
        <title>Cadastre-se</title>
    </head>
    <body>
        <h2>Cadastre-se</h2>
        <p>Por favor, preencha este formulário para criar uma conta.</p>
        <form action="" method="post">
            <div>
                <label>Usuário</label>
                <input type="text" name="username"
                       class="form-control">
                <span class="bg bg-danger"><?php echo $username_err; ?></span>
            </div>
            <div>
                <label>Senha</label>
                <input type="password" name="password"
                       class="form-control">
                <span class="bg bg-danger"><?php echo $password_err; ?></span>
            </div>
            <div>
                <label>Confirme a senha</label>
                <input type="password" name="confirm_password"
                       class="form-control">
                <span class="bg bg-danger"><?php echo $confirm_password_err; ?></span>
            </div>
            <div>
                <input type="submit" name="submit"
                       class="btn btn-primary" value="Enviar">
                <input type="reset" class="btn btn-secondary"
                       value="Limpar">
            </div>
            <p>Já tem uma conta? <a href="login.php">Faça login aqui</a>.</p>
    </body>
</html>
