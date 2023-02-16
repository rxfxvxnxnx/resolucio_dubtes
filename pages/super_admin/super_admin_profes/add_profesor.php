<?php
session_start();
if (empty($_SESSION["usuario"]) || !($_SESSION["permis"] == 0)) {
    header("Location: ../../../index.php");
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

    <link rel="shortcut icon" href="../../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../../css/pico.min.css">
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <?php
    require "../../../database.php";

    $nom = $_REQUEST["nom"];
    $cognom = $_REQUEST["cognom"];
    $email = $_REQUEST["email"];
    $email_C = false;
    $user = $_REQUEST["user"];
    $user_C = false;
    $pass = md5($_REQUEST["pass"]);
    
    $sql = "SELECT * FROM usuarios";
    $usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con));

    while($usuario = mysqli_fetch_array($usuarios)){
        if ($usuario["usuario"]==$user){
            $user_C = true;
        }
        if ($usuario["email"]==$email){
            $user_C = true;
        }
    }
    if (!str_contains($email, "@insdanielblanxart.cat")){ ?>
        <main class="container">       
            <h1>Has de Utilitzar el Domini @insdanielblanxart.cat</h1>
            <a href="../super_admin.php""><button>Tornar</button></a>
        </main>
    <?php }else if ($user_C == true || $email_C == true) { ?>
        <main class="container">       
            <h1>El Usuari o el Email Ja Esta Registrat.</h1>
            <a href="../super_admin.php""><button>Tornar</button></a>
        </main>
    <?php }else {
    $sql = "INSERT INTO usuarios VALUES (null,'".$nom."','".$cognom."','".$email."', null,'".$user."','".$pass."', 1)";
    $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
    ?> <h1 onload=window.location="../super_admin.php" ></h1><?php
    ?>
    <main class="container">       
        <h1>Usuari Creat Corectament.</h1>
        <a href="../super_admin.php"><button>Tornar</button></a>
    </main>
    <?php } ?>
</body>
</html>