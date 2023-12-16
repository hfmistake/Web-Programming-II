<?php
require_once "utils.php";
require_once "connection.php";
session_start();
$username = $password = $username_err = $password_err = "";
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: index.php");
    exit;
}

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
    if (empty($username_err) && empty($password_err)) {
        if (validateUser($username, $password)) {
            session_start();
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: index.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Usuário ou senha inválidos</div>";
        }
    }
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
        <title>Login Page</title>
    </head>
    <body>
        <div class="wrapper">
            <h2>Login</h2>
            <p>Por favor, preencha suas credenciais para fazer login.</p>
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
                    <input type="submit" class="btn btn-primary mt-3" value="Login" name="submit">
                </div>
                <p>Não tem uma conta? <a href="register.php">Cadastre-se agora</a>.</p>
            </form>
        </div>
    </body>
</html>



