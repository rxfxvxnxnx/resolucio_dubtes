<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: index.php");
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
<body class="container-fluid">
<?php
    require "../../database.php";

    $sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
    $usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con));  
    $usuario = mysqli_fetch_array($usuarios);

    $sql = "SELECT * FROM exercicis WHERE exercici ='".$_REQUEST["browser"]."'";
    $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));  
    $exercici = mysqli_fetch_array($exercicis);

    $sql = "SELECT * FROM moduls WHERE id_modul =".$exercici["modul_FK"];
    $moduls = mysqli_query($con,$sql) or exit(mysqli_error($con)); 
    $modul = mysqli_fetch_array($moduls);

    date_default_timezone_set('Europe/Madrid');
    $time = date("h:i:s a");

    $sql = "INSERT INTO consultes VALUES (null, ".$usuario["id_usuario"].", ".$exercici["id_exercici"].", ".$modul["profesor"].", '".$_REQUEST["comentari"]."', '".$time."', CURDATE(), null, 0);";

    $result = mysqli_query($con,$sql) or exit(mysqli_error($con));  

    ?>

    <main class="container">       
        <h1>Dubte Guardat. Si us plau espera...</h1>
        <a href="../../lista.php"><button>Tornar</button></a>
    </main>
</body>
</html>