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
        require "../../database.php";

        $sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
        $usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $usuario = mysqli_fetch_array($usuarios);

        if ($usuario["perfil_img"] == "") {
            $foto_perfil = "default.png";
        } else {
            $foto_perfil = $usuario["perfil_img"];
        }
    ?>
    <header>
        <nav>
            <ul>
                <li><strong class="title"><?php echo $_SESSION["usuario"] ?>.</strong></li>
            </ul>      
            <details role="list" dir="rtl">
            <summary><img class="profile" src="../../img/user_img/<?php echo $foto_perfil ?>"></summary>
            <ul>
                <li><a href="../../pages/solucio/solucio.php">Busqueda Solucions</a></li>
                <li><a href="../../pages/perfil/perfil_edit.php">Editar perfil</a></li>
                <li><a href="../../php/logout.php">Logout</a></li>
            </ul>
            </details>
        </nav>
    </header>

    <main>
        <article id="1">
            <?php
            $sql = "SELECT * FROM consultes WHERE id_consulta =".$_REQUEST["id_consulta"];

            $torns = mysqli_query($con,$sql) or exit(mysqli_error($con));
            $torn = mysqli_fetch_array($torns);

            $sql = "SELECT * FROM exercicis WHERE id_exercici = ".$torn["exercici_FK"];
            $tornsEx = mysqli_query($con,$sql) or exit(mysqli_error($con));
            $tornEx = mysqli_fetch_array($tornsEx);

            $sql = "SELECT * FROM moduls WHERE id_modul = ".$tornEx["modul_FK"];
            $modulsEx = mysqli_query($con,$sql) or exit(mysqli_error($con));
            $modulEx = mysqli_fetch_array($modulsEx);
            ?>
            <hgroup>
                <h1>Torn de 
                    <?php   $sql = "SELECT * FROM usuarios WHERE id_usuario = ".$torn["usuario_consulta_FK"];
                                    $tornsAl = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                    $tornAl = mysqli_fetch_array($tornsAl);

                                    if ($tornAl["perfil_img"] == "") {
                                        $foto_perfil = "default.png";
                                    } else {
                                        $foto_perfil = $tornAl["perfil_img"];
                                    }
                                    ?>
                                    </br>

                                    <img class="profile" src="../../img/user_img/<?php echo $foto_perfil ?>">

                                    <?php
                                    echo $tornAl["nom"]." ".$tornAl["cognom"]; 
                                    ?>.</h1>
                <h2><?php echo $modulEx["modul"] ?> - <?php echo $modulEx["uf"] ?></h2>
            </hgroup>

            <blockquote>
            <figure>
                <table role="grid">
                    <thead>
                        <tr>
                            <th>Exercici</th>
                            <th>Hora</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php 

                                echo $tornEx["exercici"]; 
                                ?>
                            </td>
                            <td>
                                <?php echo $torn["hora"] ?>
                            </td>
                            <td>
                                <?php echo $torn["date"] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table role="grid">
                    <thead>
                        <tr>
                            <th>Comentari</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $torn["comentari"] ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </figure>
            </blockquote>

            <h1>Solucio.</h1>
            <figure>
                <form action="admin_insert.php?id_consulta=<?php echo $torn['id_consulta']?>" method="POST">
                    <textarea id="solucio" name="solucio"></textarea>
                    <div class="grid">
                        <input type="submit" value="Envia o Acaba">
                        <button style="background-color:red;" onclick="location.href='admin_insert.php?id_consulta=<?php echo $torn['id_consulta']?>'">Elimina</button>
                    </div>

                </form>
            </figure>
        </article>
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

</body>
</html>