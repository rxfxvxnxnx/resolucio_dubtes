<?php
session_start();
if (empty($_SESSION["usuario"]) || !($_SESSION["permis"] == 0)) {
    header("Location: ../../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolucio de Dubtes</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container" onload=window.location="../super_admin.php">               
    <?php
        require "../../../database.php";

        $sql = "SELECT * from usuarios WHERE id_usuario = ".$_REQUEST["id_usuario"];
        $usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con)."<br>".$sql);
        $usuario = mysqli_fetch_array($usuarios);


        $sql = "DELETE FROM usuarios WHERE id_usuario = ".$_REQUEST['id_usuario'];
        // echo $sql;
        $result = mysqli_query($con,$sql);    
    ?>
</body>
</html>
