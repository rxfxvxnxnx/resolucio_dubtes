<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload=window.location="../admin/admin.php">  
<?php
    require "../../database.php";
    $sql = "DELETE FROM consultes WHERE id_consulta = ".$_REQUEST["id_consulta"];
    $result = mysqli_query($con,$sql) or exit(mysqli_error($con));  
?>
</body>
</html>