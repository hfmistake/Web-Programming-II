<?php
require_once "connection.php";
require_once "utils.php";
session_start();
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
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
        <link rel="stylesheet" href="css/styles.css">
        <script src="bootstrap/js/bootstrap.js"></script>
        <title>Galeria</title>
    </head>
    <body>
        <a href="logout.php" class="btn btn-danger ms-auto">Logout</a>
        <h1 class="ms-auto text-center mt-5">Bem vindo, <?php echo $_SESSION['username']; ?></h1>
        <h1 class="ms-auto text-center mt-5">Galeria</h1>
        <div class="container text-center mt-5">
            <a href="upload.php" class="btn btn-primary">Fazer upload</a>
            <div class="container text-center mt-5">
                <div class="row row-cols-2 row-cols-lg-3 g-2 g-lg-3">
                    <?php
                    require_once "connection.php";
                    require_once "utils.php";
                    $user_id = getCurrentUserId();
                    // fetch only images from current user
                    $sql = "SELECT * FROM image WHERE user_id = :user_id";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bindParam(':user_id', $user_id);
                    $stmt->execute();
                    $images = $stmt->fetchAll();

                    foreach ($images as $image) {
                        echo "<div class='col'>";
                        echo "<div class='card h-100'>";
                        echo "<h5 class='card-title'>" . $image['description'] . "</h5>";
                        echo "<img src='uploads/" . $_SESSION['username'] . "/" . $image['name'] . "' class='card-img-top' alt='...'>";
                        echo "<div class='card-body'>";
                        echo "<p class='card-text'>" . $image['date'] . "</p>";
                        echo "</div>";
                        echo "</div>";
                        echo "</div>";
                    }
                    ?>
                </div>
            </div>
    </body>
</html>
