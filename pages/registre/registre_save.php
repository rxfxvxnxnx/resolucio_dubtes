<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolució de Dubtes</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body>
    <?php
    $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());

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
            <a href="registre.php"><button>Tornar</button></a>
        </main>
    <?php }else if ($user_C == true || $email_C == true) { ?>
        <main class="container">       
            <h1>Usuari o Email Ya Agafat</h1>
            <a href="registre.php"><button>Tornar</button></a>
        </main>
    <?php }else {
    $sql = "INSERT INTO usuarios VALUES (null,'".$nom."','".$cognom."','".$email."','".$user."','".$pass."', 2)";
    $result = mysqli_query($con,$sql) or exit(mysqli_error($con));
    ?>
    <main class="container">       
        <h1>Usuari Creat Corectament.</h1>
        <a href="../../index.php"><button>Tornar</button></a>
    </main>
    <?php } ?>
</body>
</html>