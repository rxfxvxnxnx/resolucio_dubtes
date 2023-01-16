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
        <div class="grid">
            <article>
                <h1>Solució.</h1>
                    <div class="grid">
                        <label for="alumne">Alumne:
                            <select name="alumne" id="alumne" disabled>
                            <?php 
                            $sql="SELECT * FROM alumnes WHERE id_alumne =".$consulta["alumne_FK"];
                            $alumnes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                            while($alumne=mysqli_fetch_array($alumnes)) { ?>
                                <option value="<?php echo $alumne["id_alumne"] ?>" <?php echo ($consulta["alumne_FK"]==$alumne["id_alumne"] ? "selected":"") ?>>
                                    <?php                         
                                        echo $alumne["nom"];
                                        echo "\n";
                                        echo $alumne["cognom"];
                                    ?>
                                </option>
                            <?php
                            }
                            ?>
                            </select>
                        </label>

                        <label for="exercici">Exercici:
                            <select name="exercici" id="exercici" disabled>
                                <?php 
                                    $sql = "SELECT * FROM exercicis";
                                    $exercicis_select = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                ?>
                                <?php while($exercici_select = mysqli_fetch_array($exercicis_select)){ ?>
                                    <option value="<?php echo $exercici_select["id_exercici"] ?>"<?php echo ($consulta["exercici_FK"]==$exercici_select["id_exercici"] ? "selected":"") ?>>
                                    <?php echo $exercici_select["exercici"]; ?>                                    
                                </option>
                                <?php } ?>
                            </select>
                        </label>
                    </div>

                    <label for="resposta">Resposta:</label>
                    <?php 
                    $sql = "SELECT * FROM consultes WHERE id_consulta =".$consulta["id_consulta"];
                    $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    $consulta = mysqli_fetch_array($consultes);
                    ?>
                    <textarea name="resposta" id="resposta" type="text"><?php echo $consulta["resposta"]?></textarea>
                    <input type="hidden" name=id_consulta value="<?php echo $consulta ["id_consulta"]?>"> 
                    <input type="submit" value="Enviar" role="button" class="boto">
                </form>
<script src="../../js/modal.js"></script>
</body>
</html>
