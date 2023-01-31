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
    <title>Resolucio de Dubtes</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container">
    <?php
        $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());
        $sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
        $usuarios_foto = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $usuario_foto = mysqli_fetch_array($usuarios_foto);

        if ($usuario_foto["perfil_img"] == "") {
            $foto_perfil = "default.png";
        } else {
            $foto_perfil = $usuario_foto["perfil_img"];
        }
    ?>
    <header>
        <nav>  
            <ul>
                <li>
                    <form action="solucio.php" method="POST"  class="busqueda">
                        <input type="search" id="search" name="search" placeholder="Buscador">
                    </form>
                </li>
            </ul>
            <details role="list" dir="rtl">
                <summary><img class="profile" src="../../img/user_img/<?php echo $foto_perfil ?>"></summary>
                <ul>
                    <li><a href="../../pages/perfil/perfil_edit.php">Editar perfil</a></li>
                    <li><a href="../../php/logout.php">Logout</a></li>
                </ul>
            </details>
        </nav>
    </header>

    <main>
        <?php if($_POST["search"]=="") {
            $sql = "SELECT * FROM consultes WHERE acabada = '1'";
            $respuestas = mysqli_query($con,$sql) or exit(mysqli_error($con));

            while ($respuesta = mysqli_fetch_array($respuestas)) { ?>

            <?php }
        } ?>
    </main>
    

    <footer id="footer">
        <div>
            <img src="../../img/logo.png" class="logo">
        </div>
        <div>
            <p>
                Made by Javier Cecilia & Rafael Luiz Duarte © <?php echo date("Y"); ?>
            </p>
        </div>
        <div>
            <a href="#"><img src="../../img/arrow-up_icon-rev.png" class="flecha"></a>
        </div>
    </footer>
    <script src="../../js/script.js"></script>
</body>
</html>