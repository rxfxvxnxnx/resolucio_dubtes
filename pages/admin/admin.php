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

        $sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
        $usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $usuario = mysqli_fetch_array($usuarios);

        if ($usuario["perfil_img"] == "") {
            $foto_perfil = "default.png";
        } else {
            $foto_perfil = $usuario["perfil_img"];
        }

        $sql = "SELECT * FROM consultes WHERE acabada='0' AND profesor_FK = ".$usuario["id_usuario"];
        $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $vacio = mysqli_fetch_array($consultes);

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
        <?php 
        $sql = "SELECT * FROM consultes WHERE acabada='0' AND profesor_FK = ".$usuario["id_usuario"];
        $consultes_no = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $vacio = mysqli_fetch_array($consultes_no);     

        ?>
        <?php if(empty($vacio["id_consulta"])){?>
            <article>
                <h1 aria-busy="true">No tens dubtes que asolir, si us plau espera a que els alumnes tinguin dubtes.</h1>
            </article>
        <?php } else { ?>
            <article id="1">
                <?php
                $sql = "SELECT * FROM consultes WHERE acabada = '0' AND profesor_FK = ".$usuario["id_usuario"]." LIMIT 1";
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
                    <h1>Torn de <?php   $sql = "SELECT * FROM usuarios WHERE id_usuario = ".$torn["usuario_consulta_FK"];
                                        $tornsAl = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                        $tornAl = mysqli_fetch_array($tornsAl);
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

            <?php 
            $consulteNumero = mysqli_num_rows($consultes);
            if ($consulteNumero == 1){
            } else { ?>
            <article id="2">
                <h1>Llista.</h1>
                <figure>
                    <table role="grid">
                        <thead>
                            <tr>
                                <th>Ordre</th>
                                <th>Alumne</th>
                                <th>Exercici</th>
                                <th>Comentari</th>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Opcions</th>
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
                                    $sql = "SELECT * FROM usuarios WHERE id_usuario =".$consulte["usuario_consulta_FK"];
                                    $alumnes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                    $alumne = mysqli_fetch_array($alumnes);
                                    echo $alumne["nom"]." ".$alumne["cognom"];
                                    ?>
                                </td>
                                <td>     
                                    <?php                           
                                    $sql = "SELECT * FROM exercicis WHERE id_exercici =".$consulte["exercici_FK"];
                                    $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                    $exercici = mysqli_fetch_array($exercicis);
                                    echo $exercici["exercici"];
                                    ?>
                                </td>
                                <td>
                                    <?php echo $consulte["comentari"] ?>
                                </td>
                                <td>
                                    <?php echo $consulte["date"] ?>
                                </td>
                                <td>
                                    <?php echo $consulte["hora"] ?>
                                </td>
                                <td>
                                <a href="admin_delete.php?id_consulta=<?php echo $consulte['id_consulta']?>">Eliminar</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </figure>
            </article>
            <?php } ?>
        <?php } ?>
        
        <?php
        $sql = "SELECT * FROM moduls WHERE profesor = ".$usuario["id_usuario"];
        $moduls = mysqli_query($con,$sql) or exit(mysqli_error($con));
        while($modul = mysqli_fetch_array($moduls)){
<<<<<<< HEAD
        
        $sql = "SELECT * FROM exercicis WHERE modul_FK = ".$modul["id_modul"];
        $exercicis_buit = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $exercici_buit = mysqli_fetch_array($exercicis_buit);
=======
>>>>>>> 7bb90361cdf57051878d9a3de2d7139ba8f5633b
        ?>        
        <article id="3">        
            <div style="display: flex; justify-content: space-between;">
                    <h1><?php echo $modul["modul"] ?>. <?php echo $modul["uf"] ?></h1>
                    <?php
                    $sql = "SELECT * FROM moduls WHERE modul = '".$modul["modul"]."' AND uf = '".$modul["uf"]."'";
                    $moduls_crear = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    $modul_crear = mysqli_fetch_array($moduls_crear);

                    ?>
                    <!-- Icono Crear nuevo ejercicio -->
                    <a href="../exercicis/exercicis_create.php?id_modul_crear=<?php echo $modul_crear["id_modul"] ?>"><img src="../../img/plus_icon.png" width="37px"></a>
            </div>
            <figure>
                <?php 
                $sql = "SELECT * FROM moduls WHERE profesor = ".$usuario["id_usuario"];
                $moduls2 = mysqli_query($con,$sql) or exit(mysqli_error($con));
                $modul2 = mysqli_fetch_array($moduls2);

                $sql = "SELECT * FROM exercicis WHERE modul_FK = ".$modul["id_modul"]." ORDER BY exercici ASC";
                $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                ?>
                <?php if (!empty($exercici_buit)) { ?>
                <table role="grid">
                        <thead>
                            <tr>
                                <th>Exercici</th>
                                <th>Opcions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($exercici = mysqli_fetch_array($exercicis)) { ?>
                            <tr>
                                <td>
                                    <?php echo $exercici["exercici"] ?>
                                </td>
                                <td>
                                    <a href="../exercicis/exercicis_edit.php?id_exercici=<?php echo $exercici['id_exercici']?>">Editar</a>
                                    <a href="../exercicis/exercicis_delete.php?id_exercici=<?php echo $exercici['id_exercici']?>">Eliminar</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php } ?>
                </figure>
            </article>
        <?php } ?>

        <?php
        $sql="SELECT * FROM consultes WHERE NOT resposta = ''";
        $buidas = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $buida = mysqli_fetch_array($buidas);
        if (empty($buida["id_consulta"])){
        }else {
        ?>
        <article id="4">                
            <div style="display: flex; justify-content: space-between;">
                    <h1> Solucions.</h1>
                    <!-- Icono Crear nuevo ejercicio -->               
                </div>
            <figure>    
                <?php    
                $sql="SELECT * FROM consultes WHERE NOT resposta = ''";
                $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));          
                while($consulta = mysqli_fetch_array($consultes)) { ?>
                    <article id="card">
                        <div class="card">
                            <h1 class="text_center">
                                <?php
                                $sql = "SELECT * FROM usuarios WHERE id_usuario =".$consulta["usuario_consulta_FK"];
                                $usuaris_so = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $usuari_so = mysqli_fetch_array($usuaris_so);
                                echo $usuari_so["nom"]." ".$usuari_so["cognom"];
                                ?>
                            </h1>
                            <div class="linea"></div>
                            <div>
                                <?php
                                $sql = "SELECT * FROM exercicis WHERE id_exercici =".$consulta["exercici_FK"];
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
                            <div>
                                <h3>Problema:</h3>
                                <p>
                                <?php
                                echo $consulta["comentari"];
                                ?>
                                </p>

                            </div>
                            <div>
                                <h3>Solucio:</h3>
                                <p>
                                <?php
                                echo $consulta["resposta"];
                                ?>
                                </p>

                            </div>
                            <div class="linea"></div>
                            <div class="text_center">
                                <a href="../consultes/consultes_edit.php?id_consulta=<?php echo $consulta['id_consulta']?>">Editar</a>
                                <a href="../consultes/consultes_delete.php?id_consulta=<?php echo $consulta['id_consulta']?>">Eliminar</a>
                            </div>
                        </div>
                    </article>
                <?php } ?>
            </figure>
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