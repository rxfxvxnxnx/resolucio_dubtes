<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acutualizacion Contraseña</title>

    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container">
    <h1 class="marginTop">
<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: ../../index.php");
    exit();
}

require "../../database.php";
$sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
$usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con));
$usuario = mysqli_fetch_array($usuarios);

//Contraseña Extraida de la Base de Datos
$contraseña = $usuario["password"];
//Contraseña introducida por el usuario
$contraseña_comprobacion = md5($_POST["contraseña"]);

//Contraseña nueva 
$contraseña_primera = md5($_POST["contreseña_new"]);
//Repetir contraseña para comprobar con la de arriba 
$contraseña_repetida = md5($_POST["re_contraseña"]);

if ($contraseña == $contraseña_repetida){
    echo "La contraseña introducida es igual a la anterior";
}else{
    if ($contraseña == $contraseña_comprobacion){
        if($contraseña_primera == $contraseña_repetida){
            $sql = "UPDATE usuarios SET password = '".$contraseña_primera."'WHERE usuario = '".$_SESSION["usuario"]."'";
            $result = mysqli_query($con,$sql);
            echo "La contraseña se ha actualizado correctamente.";
        }else{
            echo"Las Contraseñas introduccidas no coinciden.";
        }
    }else{
        echo"La contraseña introduccida es incorrecta.";
}
}
?>
    </h1>
    <a href="./perfil_edit.php"><button>Tornar</button></a>
</body>
</html>