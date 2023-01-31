<?php
session_start();
if (empty($_SESSION["usuario"])) {
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
                    <form action="solucio_busqueda.php" method="POST"  class="busqueda">
                        <input type="search" id="search" name="search" placeholder="Problemas, Solucions...">
                    </form>
                </li>
            </ul>
            <details role="list" dir="rtl">
                <summary><img class="profile" src="../../img/user_img/<?php echo $foto_perfil ?>"></summary>
                <ul>
                    <li><a href="../../pages/admin/admin.php">Resolucio Dubtes</a></li>
                    <li><a href="../../pages/perfil/perfil_edit.php">Editar perfil</a></li>
                    <li><a href="../../php/logout.php">Logout</a></li>
                </ul>
            </details>
        </nav>
    </header>

    <main>
        <?php 
            $busqueda = $_POST["search"];

            $sql = "SELECT * FROM consultes WHERE acabada = '1' AND (comentari LIKE '%$busqueda%' OR resposta LIKE '%$busqueda%')";
            $respuestas = mysqli_query($con,$sql) or exit(mysqli_error($con));

            while ($respuesta = mysqli_fetch_array($respuestas)) { ?>
                    <article id="card">
                        <div class="card">
                            <h1 class="text_center">
                                <?php
                                $sql = "SELECT * FROM usuarios WHERE id_usuario =".$respuesta["usuario_consulta_FK"];
                                $usuaris_so = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $usuari_so = mysqli_fetch_array($usuaris_so);
                                echo $usuari_so["nom"]." ".$usuari_so["cognom"];
                                ?>
                            </h1>
                            <div class="linea"></div>
                            <div>
                                <?php
                                $sql = "SELECT * FROM exercicis WHERE id_exercici =".$respuesta["exercici_FK"];
                                $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $exercici = mysqli_fetch_array($exercicis);
                                
                                $sql = "SELECT * FROM moduls WHERE id_modul = ".$exercici["modul_FK"];
                                $moduls_ex = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $modul_ex = mysqli_fetch_array($moduls_ex);
                                ?>
                                <h3 class="text_center">
                                <?php
                                echo $modul_ex["modul"]." ".$modul_ex["uf"];
                                ?>
                                </h3>
                            </div>
                            <div>
                                <h3 class="text_center">
                                <?php 
                                echo $exercici["exercici"];
                                ?>
                                </h3>
                            </div>
                            <div class="linea"></div>
                            <blockquote>
                                <div>
                                    <h3>Problema:</h3>
                                    <p>
                                    <?php
                                    echo $respuesta["comentari"];
                                    ?>
                                    </p>

                                </div>
                                <div>
                                    <h3>Solucio:</h3>
                                    <p>
                                    <?php
                                    echo $respuesta["resposta"];
                                    ?>
                                    </p>
                                </div>
                            </blockquote>
                        </div>
                    </article>
            <?php } ?>
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