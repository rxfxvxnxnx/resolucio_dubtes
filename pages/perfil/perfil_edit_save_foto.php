<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: ../../index.php");
    exit();
}

$con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());

$directorio ="../../img/user_img/";

$aleatorio = mt_rand(1, 999999);

$ruta_aleatoria = $aleatorio.".png";

$ruta = "../../img/user_img/".$ruta_aleatoria;

$nombre = $_FILES['foto_perfil']['name'];

$guardado = $_FILES['foto_perfil']['tmp_name'];

if(!file_exists($directorio )){
	mkdir($directorio ,0777,true);
    if(file_exists($directorio)){
        if(move_uploaded_file($guardado, '../..img/user_img/'.$nombre)){
            $sql = "UPDATE usuarios SET perfil_img = '".$ruta_aleatoria."' WHERE usuario = '".$_SESSION["usuario"]."'";
            $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
            echo "Archivo guardado con exito";
        }else{
            echo "Archivo no se pudo guardar";
        }
    }
}else{
        if(move_uploaded_file($guardado, $directorio.$aleatorio.".png")){
        $sql = "UPDATE usuarios SET perfil_img = '".$ruta_aleatoria."' WHERE usuario = '".$_SESSION["usuario"]."'";
        $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
        echo "Archivo guardado con exito";

    }elseif(move_uploaded_file($guardado, $directorio.$aleatorio.".pdf")){
        $sql = "UPDATE usuarios SET perfil_img = '".$ruta_aleatoria."' WHERE usuario = '".$_SESSION["usuario"]."'";
        $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
        echo "Archivo guardado con exito";
    }else{
        echo "Archivo no se pudo guardar";
    }

    var_dump($ruta);

}
?>