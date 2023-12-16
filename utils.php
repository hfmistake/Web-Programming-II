<?php
require_once "connection.php";
function validateUser($username, $password): bool
{
    global $conexao;
    $sql = "SELECT password FROM user WHERE username = :username";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $hashedPassword = $stmt->fetchColumn();
    if ($hashedPassword && password_verify($password, $hashedPassword)) {
        return true;
    } else {
        return false;
    }
}

function createUser($username, $password): bool
{
    global $conexao;
    $password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO user (username, password) VALUES (:username, :password)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    return $stmt->execute();
}

function validateNullFile($file): bool
{
    return $file["error"] == 4;
}

function isImageValid($file): bool
{
    $allowedExtensions = ['jpeg', 'jpg', 'png'];
    $fileType = explode('.', $file["name"]);
    return in_array(strtolower(end($fileType)), $allowedExtensions);
}

function saveImageDB($description, $name): bool
{
    global $conexao;
    $sql = "INSERT INTO image (description, name, date, user_id) VALUES (:description, :name , NOW(), :user_id)";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':name', $name);
    $user_id = getCurrentUserId();
    $stmt->bindParam(':user_id', $user_id);
    return $stmt->execute();
}

function getCurrentUserId(): int
{
    global $conexao;
    $sql = "SELECT id FROM user WHERE username = :username";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    return $stmt->fetchColumn();
}