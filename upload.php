<!doctype html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <script src="bootstrap/js/bootstrap.js"></script>
        <title>Fazer upload</title>
    </head>
    <body class="container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="formFile" class="form-label p-2">Escolha seu arquivo de imagem</label>
                <input class="form-control" type="file" name="file" id="formFile">
                <input class="form-control" type="text" name="description" placeholder="Descreva sua imagem">
                <button class="btn btn-primary mt-3 col-4 offset-4" type="submit" name="submit">Enviar</button>
            </div>
        </form>
    </body>
</html>

<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
require_once "utils.php";
if (isset($_POST["submit"])) {
    $arquivo = $_FILES["file"];
    if (validateNullFile($arquivo)) {
        echo "<div class='alert alert-danger' role='alert'>Você não selecionou nenhum arquivo</div>";
        die();
    }
    if (!isImageValid($arquivo)) {
        echo "<div class='alert alert-danger' role='alert'>O arquivo selecionado não é uma imagem válida</div>";
        die();
    } else {
        if (!file_exists('uploads/' . $_SESSION['username'])) {
            mkdir('uploads/' . $_SESSION['username'], true);
        }
        move_uploaded_file($arquivo["tmp_name"], 'uploads/' . $_SESSION['username'] . '/' . $arquivo["name"]);
        saveImageDB($_POST['description'], $arquivo["name"]);
        echo "<div class='alert alert-success' role='alert'>Upload realizado com sucesso</div>";
        header("location: index.php");
    }
}