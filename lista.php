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
            <input type="search" list="browsers" name="browser" id="browser" placeholder="Busca el exercici..."  required>
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
            <script>
                document.getElementById('browser').addEventListener('change', function() {
                    var searchValue = this.value.toLowerCase().trim();
                    var validOption = false;
                    var options = document.getElementById('browsers').options;
                    var closestOption = null;
                    var closestDistance = Infinity;
                    
                    for (var i = 0; i < options.length; i++) {
                        var optionValue = options[i].value.toLowerCase();
                        if (optionValue === searchValue) {
                            validOption = true;
                            closestOption = options[i];
                            break;
                        } else {
                            var distance = levenshteinDistance(optionValue, searchValue);
                            if (distance < closestDistance) {
                                closestDistance = distance;
                                closestOption = options[i];
                            }
                        }
                    }
                    
                    if (!validOption) {
                        this.value = closestOption.value;
                    }
                });

                // Calculates the Levenshtein distance between two strings
                function levenshteinDistance(s, t) {
                    var d = [];
                    for (var i = 0; i <= s.length; i++) {
                        d[i] = [i];
                    }
                    for (var j = 1; j <= t.length; j++) {
                        d[0][j] = j;
                    }
                    for (var i = 1; i <= s.length; i++) {
                        for (var j = 1; j <= t.length; j++) {
                            if (s.charAt(i - 1) === t.charAt(j - 1)) {
                                d[i][j] = d[i - 1][j - 1];
                            } else {
                                var deletion = d[i - 1][j] + 1;
                                var insertion = d[i][j - 1] + 1;
                                var substitution = d[i - 1][j - 1] + 1;
                                d[i][j] = Math.min(deletion, insertion, substitution);
                            }
                        }
                    }
                    return d[s.length][t.length];
                }
            </script>


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
                        <?php
                        while($llista = mysqli_fetch_array($llista_torns)) { ?>
                        <tr>
                            <td>
                                <?php
                                echo $num
                                ?>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM usuarios WHERE id_usuario=".$llista["usuario_consulta_FK"];
                                $usuarios_lista = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $usuario_lista = mysqli_fetch_array($usuarios_lista);

                                if ($usuario_lista["perfil_img"] == "") {
                                    $foto_perfil = "default.png";
                                } else {
                                    $foto_perfil = $usuario_lista["perfil_img"];
                                }
                                ?>

                                <img class="profile" src="img/user_img/<?php echo $foto_perfil ?>">

                                <?php
                                echo $usuario_lista["nom"]." ".$usuario_lista["cognom"];

                                $num = $num + 1;
                                ?>
                            </td>
                        </tr>
                        <?php } ?>
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