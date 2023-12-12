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
    <body>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3 d-inline-block">
                <label for="formFile" class="form-label p-2">Escolha seu arquivo de imagem</label>
                <input class="form-control" type="file" name="file" id="formFile">
                <button class="btn btn-primary" type="submit" name="submit">Enviar</button>
            </div>
        </form>
    </body>
</html>

<?php
require_once "utils.php";
session_start();
$_SESSION['user'] = 'admin';
if (isset($_POST["submit"])) {
    $arquivo = $_FILES["file"];
    if (validateEmptyFile($arquivo)) {
        die("Você não escolheu nenhum arquivo");
    }
    if (!isImageValid($arquivo)) {
        die("Você não pode fazer upload deste tipo de arquivo");
    } else {
        if (!file_exists('uploads/' . $_SESSION['user'])) {
            mkdir('uploads/' . $_SESSION['user'], true);
        }
        move_uploaded_file($arquivo["tmp_name"], 'uploads/' . $_SESSION['user'] . '/' . $arquivo["name"]);
        echo "Upload foi feito com sucesso.";
    }
}