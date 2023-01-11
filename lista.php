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
<body class="container"></body>                
    <?php
        $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());
        $sql = "SELECT * FROM consultes WHERE acabada='0'";
        $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
    ?>
    <header>
        <nav>
            <ul>
                <li><strong class="title"><?php echo $_SESSION["usuario"] ?>.</strong></li>
            </ul>
            <ul>
                <li class="pointer"><a data-target="modal-example" href="php/logout.php"><img src="img/login_icon.png" alt="" width="30px"></a></li>
            </ul>
        </nav>
    </header>
    <main>      
        <div class="grid">
            <article>
                <h1>Formulari.</h1>
                <form action="pages/consultes/consultes_save.php" method="POST">

                        <label for="exercici">Exercici:
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
                        </label>
                    </div>

                    <label for="comentari">Comentari:</label>
                    <textarea name="comentari" id="comentari" type="text" required></textarea>

                    <input type="submit" value="Enviar" role="button" class="boto">
                </form>
            </article>
            <article>
                <h1>Torns.</h1>
                <figure>
                    <table role="grid">
                        <thead>
                            <tr>
                                <th>Ordre</th>
                                <th>Alumne</th>
                                <th>Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; while($consulte = mysqli_fetch_array($consultes)) { $i++; ?>
                            <tr>
                                <td>
                                    <?php echo $i; ?>
                                </td>
                                <td>
                                    <?php 
                                    $sql = "SELECT * FROM alumnes WHERE id_alumne =".$consulte["alumne_FK"];
                                    $alumnes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                    $alumne = mysqli_fetch_array($alumnes);
                                    echo $alumne["nom"]." ".$alumne["cognom"];
                                    ?>
                                </td>
                                <td>
                                    <?php echo $consulte["hora"] ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </figure>
            </article>

        </div> 

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
                                $sql = "SELECT * FROM alumnes WHERE id_alumne =".$consulte_so["alumne_FK"];
                                $alumnes_so = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $alumne_so = mysqli_fetch_array($alumnes_so);
                                echo $alumne_so["nom"]." ".$alumne_so["cognom"];
                            ?>
                            </h1>
                            <div class="linea"></div>
                            <div>
                                <h3>Exercici:</h3>
                                <?php
                                $sql = "SELECT * FROM exercicis WHERE id_exercici = ".$consulte_so["exercici_FK"];
                                $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $exercici = mysqli_fetch_array($exercicis); 
                                ?>
                                <p><?php echo $exercici["exercici"] ?></p>
                            </div>
                            <div>
                                <h3>Problema:</h3>
                                <p><?php echo $consulte_so["comentari"] ?></p>
                            </div>
                            <div>
                                <h3>Solució:</h3>
                                <p><?php echo $consulte_so["resposta"] ?></p>
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
    <footer>

    </footer>
<script src="js/modal.js"></script>
</body>
</html>