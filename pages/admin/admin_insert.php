<?php
session_start();
if (empty($_SESSION["usuario"]) || $_SESSION["permis"] == 2) {
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
    <title>Enviar Solucio</title>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
</head>
<body onload=window.location="admin.php">
    <?php
        require "../../database.php";
        $sql = "UPDATE consultes SET acabada='1', resposta=\"".$_REQUEST["solucio"]."\" WHERE id_consulta = ".$_REQUEST['id_consulta'];
        try {
            $result = mysqli_query($con,$sql) or exit(mysqli_error($con)); ?>
        <br>
        <?php
        } catch (mysqli_sql_exception $e) {
            // print_r($e);
            if($e->getCode()==1451) { // Foreign keys error
                echo "<script>alert('No es pot eliminar aquest exercici encara te consultes');</script>";
                ?>
            <?php        
            }else{
                echo $sql;
                echo "Ha succeït l'error ".$e->getCode()." - " .$e->getMessage(); ?>
            <?php
            }
        }
        ?>
</html>