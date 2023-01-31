<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolució de Dubtes</title>

    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/pico.min.css">
    <link rel="stylesheet" href="css/style.css">
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

        $sql = "SELECT * FROM consultes WHERE acabada='0'";
        $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
    ?>
    <header>
        <nav>
            <ul>
                <li><strong class="title"><?php echo $_SESSION["usuario"] ?>.</strong></li>
            </ul>
            <details role="list" dir="rtl">
                <summary><img class="profile" src="./img/user_img/<?php echo $foto_perfil ?>"></summary>
                <ul>
                    <li><a href="../../pages/solucio/solucio.php">Busqueda Solucions</a></li>
                    <li><a href="./pages/perfil/perfil_edit.php">Editar perfil</a></li>
                    <li><a href="./php/logout.php">Logout</a></li>
                </ul>
            </details>
        </nav>
    </header>
    <main>      
        <article>
            <h1>Formulari.</h1>
            <form action="pages/consultes/consultes_save.php" method="POST">

                    <label for="exercici">Exercici:>
                        <select name="exercici" id="exercici">
                            <?php 
                                $sql = "SELECT * FROM exercicis";
                                $exercicis_select = mysqli_query($con,$sql) or exit(mysqli_error($con));
                            ?>
                            <?php while($exercici_select = mysqli_fetch_array($exercicis_select)){ ?>
                                <option value="<?php echo $exercici_select["id_exercici"] ?>">
                                    <?php echo $exercici_select["exercici"] ?>
                                </option>
                            <?php } ?>
                        </select>

                <label for="comentari">Comentari:</label>
                <textarea name="comentari" id="comentari" type="text" required></textarea>

                <input type="submit" value="Enviar" role="button" class="boto">
            </form>
        </article>

        <?php
        $sql="SELECT * FROM consultes WHERE NOT resposta = ''";
        $buidas = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $buida = mysqli_fetch_array($buidas);
        if (empty($buida["id_consulta"])){
        }else {
        ?>
        <article>
            <figure>
                <h1>Solucions.</h1>
                <?php 
                $sql="SELECT * FROM consultes WHERE NOT resposta = ''";
                $consultes_so = mysqli_query($con,$sql) or exit(mysqli_error($con)); 
                while($consulte_so = mysqli_fetch_array($consultes_so)) { ?>
                    <article id="card">
                        <div class="card">
                        <h1 class="text_center">
                                <?php
                                $sql = "SELECT * FROM usuarios WHERE id_usuario =".$consulte_so["usuario_consulta_FK"];
                                $usuaris_so = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $usuari_so = mysqli_fetch_array($usuaris_so);
                                echo $usuari_so["nom"]." ".$usuari_so["cognom"];
                                ?>
                            </h1>
                            <div>
                                <?php
                                $sql = "SELECT * FROM exercicis WHERE id_exercici =".$consulte_so["exercici_FK"];
                                $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $exercici = mysqli_fetch_array($exercicis);
                                
                                $sql = "SELECT * FROM moduls WHERE id_modul = ".$exercici["modul_FK"];
                                $moduls_ex = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $modul_ex = mysqli_fetch_array($moduls_ex);
                                ?>
                                <h5 class="text_center">
                                <?php
                                echo $modul_ex["modul"]." ".$modul_ex["uf"];
                                ?>
                                </h5>
                            </div>
                            <div>
                                <h5 class="text_center">
                                <?php 
                                echo $exercici["exercici"];
                                ?>
                                </h5>
                            </div>
                            <div class="linea"></div>
                            <div>
                                <h3>Problema:</h3>
                                <p>
                                <?php
                                echo $consulte_so["comentari"];
                                ?>
                                </p>

                            </div>
                            <div>
                                <h3>Solucio:</h3>
                                <p>
                                <?php
                                echo $consulte_so["resposta"];
                                ?>
                                </p>

                            </div>
                            <div class="linea"></div>
                            <p class="text_center"><?php echo $consulte_so["date"] ?></p>
                        </div>
                    </article>
                <?php } ?>
            </figure>
        </article>
        <?php } ?>
    </main>

    <footer id="footer">
        <div>
            <img src="img/logo.png" class="logo">
        </div>
        <div>
            <p>
                Made by Javier Cecilia & Rafael Luiz Duarte © <?php echo date("Y"); ?>
            </p>
        </div>
        <div>
            <a href="#"><img src="img/arrow-up_icon-rev.png" class="flecha"></a>
        </div>
    </footer>
<script src="js/script.js"></script>
</body>
</html>