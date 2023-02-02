<?php
session_start();
if (empty($_SESSION["usuario"]) || $_SESSION["permis"] == 2) {
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
    <title>Resolucio de Dubtes</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/pico.min.css">
</head>
<body class="container">
    <?php 
        require "../../database.php";
        $sql = "SELECT * FROM exercicis WHERE id_exercici =".$_REQUEST["id_exercici"];
        $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $exercici = mysqli_fetch_array($exercicis);
    ?>
        <article>
            <h1>Editar exercici.</h1>
            <form action="exercicis_edit_save.php" method="POST">
                <label for="edit_exercici">Nom Exercici:</label>
                <input name="edit_exercici" id="edit_exercici" type="text" value="<?php echo $exercici["exercici"] ?>">
            
                <label for="edit_modul">Edita Modul:</label>
                <select name="edit_modul" id="edit_modul">
                    <?php 
                    $sql = "SELECT * FROM usuarios WHERE usuario='".$_SESSION["usuario"]."'";
                    $usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    $usuario = mysqli_fetch_array($usuarios);

                    $sql = "SELECT * FROM moduls WHERE profesor=".$usuario["id_usuario"];
                    $moduls = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    while($modul = mysqli_fetch_array($moduls)){?>
                        <option value="<?php echo $modul["id_modul"] ?>"><?php echo $modul["modul"] ?>/<?php echo $modul["uf"] ?></option>
                    <?php } ?>

                </select>
                <input type="submit" value="Enviar" role="button" class="boto">
            </form>
        </article>
    </main>
</body>
</html>