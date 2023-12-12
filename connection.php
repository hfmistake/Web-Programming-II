<?php

try {
    $DB_USERNAME = getenv('DB_USER'); // substituir aqui o seu username do banco
    $DB_PASSWORD = getenv('DB_PASSWORD'); // substituir aqui o seu password do banco
    $conexao = new PDO('mysql:host=localhost; dbname=galeria', $DB_USERNAME, $DB_PASSWORD);
} catch (Exception $erro) {
    echo "<h2>Mensagem de erro: {$erro->getMessage()} </h2>";
    echo "<h2>Código de erro: {$erro->getCode()} </h2>";
}