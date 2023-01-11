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
<body class="container"></body>                
    <?php
        $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());
        $sql = "SELECT * FROM consultes WHERE acabada='0'";
        $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $vacio = mysqli_fetch_array($consultes);

        $sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
        $usuarios = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $usuario = mysqli_fetch_array($usuarios);
    ?>
    <header>
        <nav>
            <ul>
                <li><a class="secondary pointer" onclick="mostrar()"><img src="../../img/menu_icon.png" alt="" width="30px"></a></li>
            </ul>
            <ul>
                <li><strong class="title"><?php echo $_SESSION["usuario"] ?>.</strong></li>
            </ul>
            <ul>
                <li class="pointer"><a href="../../php/logout.php"><img src="../../img/login_icon.png" alt="" width="30px"></a></li>
            </ul>
        </nav>
        <aside id="menu">
            <nav class="menu_desple">
                <li><h4><a href="#2" onclick="guardar()">Llista</a></h4></li>
                <li><h4><a href="#3" onclick="guardar()">Exercicis</a></h4></li>
                <li><h4><a href="#4" onclick="guardar()">Solucions</a></h4></li>
                </ul>
            </nav>
        </aside>
    </header>
    <main>
        <?php 
        $sql = "SELECT * FROM consultes WHERE acabada='0'";
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
                $sql = "SELECT * FROM consultes WHERE acabada='0' LIMIT 1";
                $torns = mysqli_query($con,$sql) or exit(mysqli_error($con));
                $torn = mysqli_fetch_array($torns);
                ?>
                <h1>Torn de <?php 
                                    $sql = "SELECT * FROM usuarios WHERE id_usuario = ".$torn["usuario_consulta_FK"];
                                    $tornsAl = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                    $tornAl = mysqli_fetch_array($tornsAl);
                                    echo $tornAl["nom"]." ".$tornAl["cognom"]; 
                                    ?>.</h1>
                <figure>
                    <table role="grid">
                        <thead>
                            <tr>
                                <th>Exercici</th>
                                <th>Comentari</th>
                                <th>Hora</th>
                                <th>Opcions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <?php 
                                    $sql = "SELECT * FROM exercicis WHERE id_exercici = ".$torn["exercici_FK"];
                                    $tornsEx = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                    $tornEx = mysqli_fetch_array($tornsEx);
                                    echo $tornEx["exercici"]; 
                                    ?>
                                </td>
                                <td>
                                    <?php echo $torn["comentari"] ?>
                                </td>
                                <td>
                                    <?php echo $torn["hora"] ?>
                                </td>
                                <td>
                                    <a href="admin_insert.php?id_consulta=<?php echo $torn['id_consulta']?>">Eliminar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </figure>

                <h1>Solucio.</h1>
                <figure>
                    <form action="admin_insert.php?id_consulta=<?php echo $torn['id_consulta']?>" method="POST">
                        <textarea id="solucio" name="solucio"></textarea>
                        <input type="submit" value="Envia o Acaba">
                    </form>
                </figure>
            </article>

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
        
        
        <article id="3">                
            <div style="display: flex; justify-content: space-between;">
                    <h1> Exercicis.</h1>
                    <!-- Icono Crear nuevo ejercicio -->
                    <a href="../exercicis/exercicis_create.php"><img src="../../img/plus_icon.png" width="37px"></a>
                </div>
            <figure>
                <table role="grid">
                    <?php 
                    $sql = "SELECT * FROM moduls WHERE profesor = ".$usuario["id_usuario"];
                    $moduls = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    $modul = mysqli_fetch_array($moduls);

                    $sql = "SELECT * FROM exercicis WHERE modul_FK = ".$modul["id_modul"];
                    $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                    ?>
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
                                <a href="../exercicis/exercicis_delete.php?id_exercici=<?php echo $exercici['id_exercici']?>">Eliminar</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </figure>
        </article>

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
                                $sql = "SELECT * FROM alumnes WHERE id_alumne =".$consulta["alumne_FK"];
                                $alumnes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $alumne = mysqli_fetch_array($alumnes);
                                echo $alumne["nom"]." ".$alumne["cognom"];
                                ?>
                            </h1>
                            <div class="linea"></div>
                            <div>
                                <h3>Exercici:</h3>  
                                <p>
                                <?php 
                                $sql = "SELECT * FROM exercicis WHERE id_exercici =".$consulta["exercici_FK"];
                                $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $exercici = mysqli_fetch_array($exercicis);
                                echo $exercici["exercici"];
                                ?>
                                </p>
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
    <footer>
    </footer>
    <script src="../../js/script.js"></script>
</body>
</html>