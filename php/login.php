<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../css/pico.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="container">
    <h1 class="marginTop">
        <?php
        require "../database.php";

        $sql = "SELECT * FROM usuarios WHERE usuario = '".$_POST["user"]."'";
        
        $users = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $user = mysqli_fetch_array($users);

        if (empty($user)) {

            echo "El Usuario o la Contraseña son Incorrectos";

        } else {

            $usuario_correcto = $user["usuario"];
            $palabra_secreta_correcta = $user["password"];
            $permis = $user["permis"];
            
            $usuario = $_POST["user"];
            $palabra_secreta = md5($_POST["password"]);
            
            if ($usuario == $usuario_correcto && $palabra_secreta == $palabra_secreta_correcta  && $permis == 1) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["permis"] = $permis;
                header("Location: ../pages/admin/admin.php");

            } else if ($usuario == $usuario_correcto && $palabra_secreta == $palabra_secreta_correcta  && $permis == 2) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["permis"] = $permis;
                header("Location: ../lista.php");
            } else if ($usuario == $usuario_correcto && $palabra_secreta == $palabra_secreta_correcta  && $permis == 0) {
                session_start();
                $_SESSION["usuario"] = $usuario;
                $_SESSION["permis"] = $permis;
                header("Location: ../pages/super_admin/super_admin.php");
            } 
            else {
                echo "El Usuario o la Contraseña son Incorrectos";
            }
        }


        ?>
    </h1>
    <a href="../index.php"><button>Tornar</button></a>
</body>
</html>

