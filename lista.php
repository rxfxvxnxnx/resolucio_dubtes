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
    require "database.php";

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
                    <li><a href="pages/solucio/solucio.php">Busqueda Solucions</a></li>
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

                    <label for="exercici">Exercici:</label>
                        <input type="search" list="browsers" name="browser" id="browser" placeholder="Busca el exercici...">
                        <datalist id="browsers">
                            <?php 
                                $sql = "SELECT * FROM exercicis";
                                $exercicis_select = mysqli_query($con,$sql) or exit(mysqli_error($con));
                            ?>
                            <?php 
                                while($exercici_select = mysqli_fetch_array($exercicis_select)){ 

                                $sql = "SELECT * FROM moduls WHERE id_modul = ".$exercici_select["modul_FK"];
                                $moduls_exercici = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $modul_exercici = mysqli_fetch_array($moduls_exercici);

                            ?>
                                <option value="<?php echo $exercici_select["exercici"] ?>"><?php echo $modul_exercici["modul"] ?> - <?php echo $modul_exercici["uf"] ?> - <?php echo $exercici_select["exercici"] ?></option>
                            <?php } ?>
                        </datalist>

                <label for="comentari">Comentari:</label>
                <textarea name="comentari" id="comentari" type="text" required></textarea>

                <input type="submit" value="Enviar" role="button" class="boto">
            </form>
        </article>
        <article>
            <h1>Torns.</h1>
            <?php 
            $sql = "SELECT * FROM usuarios WHERE permis = 1";
            $profesors = mysqli_query($con,$sql) or exit(mysqli_error($con));

            while($profesor = mysqli_fetch_array($profesors)) { ?>

            <article>
                <h3><?php echo $profesor["nom"]." ".$profesor["cognom"].".";
                $num = 1;
                $sql = "SELECT * FROM consultes WHERE profesor_FK =".$profesor["id_usuario"]." AND acabada = 0";
                $llista_torns = mysqli_query($con,$sql) or exit(mysqli_error($con));

                $sql = "SELECT * FROM consultes WHERE profesor_FK =".$profesor["id_usuario"]." AND acabada = 0";
                $buits = mysqli_query($con,$sql) or exit(mysqli_error($con));

                if (!empty($buit = mysqli_fetch_array($buits))) {
                ?></h3>

                <table role="grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Alumne</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <?php
                        while($llista = mysqli_fetch_array($llista_torns)) { ?>
                            <th>
                                <?php
                                echo $num
                                ?>
                            </th>
                            <th>
                                <?php
                                $sql = "SELECT * FROM usuarios WHERE id_usuario=".$llista["usuario_consulta_FK"];
                                $usuarios_lista = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $usuario_lista = mysqli_fetch_array($usuarios_lista);
                                
                                echo $usuario_lista["nom"]." ".$usuario_lista["cognom"];
                                ?>
                            </th>
                        <?php } ?>
                        </tr>
                    </tbody>
                    <tfoot>

                    </tfoot>
                </table>
                <?php } else {?>
                    <h5 aria-busy="true">Encara no te dubtes, vols ser el primer?</h5>
                <?php } ?>
            </article>
            <?php } ?>
        </article>

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