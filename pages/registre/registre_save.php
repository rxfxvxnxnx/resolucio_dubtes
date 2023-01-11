<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolució de Dubtes</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <?php
    $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());
    $sql = "INSERT INTO usuarios VALUES (null,'".$_REQUEST["nom"]."','".$_REQUEST["cognom"]."','".$_REQUEST["email"]."','".$_REQUEST["user"]."','".$_REQUEST["pass"]."', 2)";
    $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
    ?>
    <main class="container">       
        <h1>Usuari Creat Corectament.</h1>
        <a href="../../index.php"><button>Tornar</button></a>
    </main>
</body>
</html>