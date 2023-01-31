<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("Location: ../../lista.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solució</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container"></body>                
    <?php
            $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());
            $sql = "SELECT * FROM consultes WHERE id_consulta =".$_REQUEST["id_consulta"];
            $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
            $consulta = mysqli_fetch_array($consultes)
    ?>
    <header>
        <nav>
            <ul>
                <li><strong class="title">Editar Solució.</strong></li>
            </ul>
        </nav>
        <main>
        <form action="consultes_edit_save.php" method="POST">

        <article>
            <h1>Solució.</h1>
            <div class="grid">
                <label for="alumne">Alumne:
                    <?php 
                    $sql="SELECT * FROM usuarios WHERE id_usuario =".$consulta["usuario_consulta_FK"];
                    $alumnes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    $alumne=mysqli_fetch_array($alumnes);
                    ?>
                    <input type="text" value="<?php echo $alumne["nom"] ?> <?php echo $alumne["cognom"] ?>" disabled>
                </label>

                <label for="modul">Modul:
                    <?php
                    $sql = "SELECT * FROM exercicis WHERE id_exercici =".$consulta["exercici_FK"];
                    $exercicis_select = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    $exercici_select = mysqli_fetch_array($exercicis_select);

                    $sql = "SELECT * FROM moduls WHERE id_modul = ".$exercici_select["modul_FK"];
                    $moduls = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    $modul = mysqli_fetch_array($moduls);
                    ?>
                    <input type="text" value="<?php echo $modul["modul"] ?> - <?php echo $modul["uf"] ?>" disabled>
                </label>
            </div>

                <label for="exercici">Exercici:
                        <?php 
                        ?>
                        <input type="text" value="<?php echo $exercici_select["exercici"] ?>" disabled>
                </label>

            <label for="resposta">Resposta:</label>
            <?php 
            $sql = "SELECT * FROM consultes WHERE id_consulta =".$consulta["id_consulta"];
            $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
            $consulta = mysqli_fetch_array($consultes);
            ?>
            <textarea name="resposta" id="resposta" type="text"><?php echo $consulta["resposta"]?></textarea>
            <input type="hidden" name=id_consulta value="<?php echo $consulta ["id_consulta"]?>"> 
            <input type="submit" value="Edita" role="button" class="boto">
        </article>
<script src="../../js/modal.js"></script>
</body>
</html>
