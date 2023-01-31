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
    $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());

    date_default_timezone_set('Europe/Madrid');
    
    $time = date("h:i:s a");

    $sql = "INSERT INTO consultes VALUES (null, ".$_REQUEST["alumne"].", ".$_REQUEST["exercici"].", '".$_REQUEST["comentari"]."', '".$time."', CURDATE(), null, 0);";

    $result = mysqli_query($con,$sql) or exit(mysqli_error($con));  

    ?>

    <main class="container">       
        <h1>Dubte Guardat. Si us plau espera...</h1>
        <a href="../../lista.php"><button>Tornar</button></a>
    </main>
</body>
</html>