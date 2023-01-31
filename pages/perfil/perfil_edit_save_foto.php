<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: ../../index.php");
    exit();
}

$con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());
$sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
$usuarios_foto = mysqli_query($con,$sql) or exit(mysqli_error($con));
$usuario_foto = mysqli_fetch_array($usuarios_foto);
$foto_perfil = $usuario_foto["perfil_img"];

$directorio ="../../img/user_img/";
$aleatorio = mt_rand(1, 999999);
$ruta_aleatoria = $aleatorio.".png";

$nombre = $_FILES['foto_perfil']['name'];
$guardado = $_FILES['foto_perfil']['tmp_name'];

if(file_exists($directorio )){
    unlink('../../img/user_img/'.$foto_perfil);
} else {
    mkdir($directorio ,0777,true);
}

if(move_uploaded_file($guardado, $directorio.$aleatorio.".png")){
    $sql = "UPDATE usuarios SET perfil_img = '".$ruta_aleatoria."' WHERE usuario = '".$_SESSION["usuario"]."'";
    $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
    echo "Archivo guardado con exito";
} else {
    echo "Archivo no se pudo guardar";
}

mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body onload=window.location="perfil_edit.php">
</body>
</html>
