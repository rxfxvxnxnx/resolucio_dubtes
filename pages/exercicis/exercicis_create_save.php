<?php
session_start();
if (empty($_SESSION["usuario"]) || $_SESSION["permis"] == 2) {
    header("Location: ../../lista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload=window.location="../admin/admin.php">
    <?php
        require "../../database.php";
        $sql = "INSERT INTO exercicis VALUES (null,'".$_REQUEST["id_modul"]."','".$_REQUEST["nou_exercici"]."')";
        $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
    ?>
</body>
</html>