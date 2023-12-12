<?php
require_once "connection.php";
function validateUser($username, $password)
{
    global $conexao;
    $sql = "SELECT * FROM user WHERE user = :username AND password = :password";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':user', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function validateNullFile($file)
{
    return $file["error"] == 4;
}

function isImageValid($file)
{
    $allowedExtensions = ['jpeg', 'jpg', 'png'];
    $fileType = explode('.', $file["name"]);
    return in_array(strtolower(end($fileType)), $allowedExtensions);
}
