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
    ?>
    <header>
        <nav>
            <ul>
                <li><a class="secondary pointer" onclick="mostrar()"><img src="../../img/menu_icon.png" alt="" width="30px"></a></li>
            </ul>
            <ul>
                <li>
                    <form action="solucio.php" method="POST"  class="busqueda">
                        <input type="search" id="search" name="search" placeholder="Buscador">
                    </form>
                </li>
            </ul>
            <ul>
                <li class="pointer"><a href="../../php/logout.php"><img src="../../img/login_icon.png" alt="" width="30px"></a></li>
            </ul>
        </nav>
        <aside id="menu">
            <nav class="menu_desple">
                <li><h4><a href="#2" onclick="guardar()">Llista</a></h4></li>
                <li><h4><a href="#3" onclick="guardar()">Exercicis</a></h4></li>
                <li><h4><a href="#4" onclick="guardar()">Solucions</a></h4></li>
                </ul>
            </nav>
        </aside>
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