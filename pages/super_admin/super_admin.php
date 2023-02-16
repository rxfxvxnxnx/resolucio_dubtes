<?php
session_start();
if (empty($_SESSION["usuario"]) || !($_SESSION["permis"] == 0)) {
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

        $sql = "SELECT * FROM consultes WHERE acabada='0' AND profesor_FK = ".$usuario["id_usuario"];
        $consultes_usuario = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $vacio = mysqli_fetch_array($consultes_usuario);

    ?>
    <header>
        <nav>
            <ul>
                <li><strong class="title"><?php echo $_SESSION["usuario"] ?>.</strong></li>
            </ul>      
            <details role="list" dir="rtl">
            <summary><img class="profile" src="../../img/user_img/<?php echo $foto_perfil ?>"></summary>
            <ul>
                <li><a href="#1">Users Alumnes</a></li>
                <li><a href="#2">Users Profesors</a></li>
                <li><a href="#3">Consultes</a></li>
                <li><a href="#4">Moduls</a></li>
                <li><a href="#5">Exercicis</a></li>
                <li><a href="../../php/logout.php">Logout</a></li>
            </ul>
            </details>
        </nav>
    </header>
    <main>

        <article id="1">
            <h1>Users Profesors.</h1>
            <figure>
                <table role="grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Usuari</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM usuarios WHERE permis = 1";
                        $usuarios_profesors = mysqli_query($con,$sql) or exit(mysqli_error($con));
                        while($usuario_profesor = mysqli_fetch_array($usuarios_profesors)){;
                        if(!empty($usuario_profesor["id_usuario"])){
                        ?>
                        <tr>
                            <td>
                                <?php
                                echo $usuario_profesor["id_usuario"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $usuario_profesor["nom"]." ".$usuario_profesor["cognom"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $usuario_profesor["usuario"];
                                ?>
                            </td>
                            <td>
                                <a href="">Editar</a>
                                <a href="">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                        }
                        } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="afegir_superadmin">
                                <a href="./super_admin_profes/create_profesor.php">Afegir Users Profesors</a>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </figure>
        </article>

        <article id="2">
            <h1>Users Alumnes.</h1>
            <figure>
                <table role="grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Usuari</th>
                            <th>Email</th>
                            <th>Options</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM usuarios WHERE permis = 2";
                        $usuarios_alumnos = mysqli_query($con,$sql) or exit(mysqli_error($con));
                        while($usuario_alumno = mysqli_fetch_array($usuarios_alumnos)){;
                        if(!empty($usuario_alumno["id_usuario"])){
                        ?>
                        <tr>
                            <td>
                                <?php
                                echo $usuario_alumno["id_usuario"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $usuario_alumno["nom"]." ".$usuario_alumno["cognom"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $usuario_alumno["usuario"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $usuario_alumno["email"];
                                ?>
                            </td>
                            <td>
                                <a href=./super_admin_usuarios/eliminar_usuario.php?id_usuario=<?php echo $usuario_alumno["id_usuario"] ?>>Eliminar</a>
                            </td>
                            <td>
                                <a href=./super_admin_usuarios/reset_contraseña.php?id_usuario=<?php echo $usuario_alumno["id_usuario"] ?>>Reset Contraseña</a>
                            </td>
                        </tr>
                        <?php
                        }
                        } 
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="4" class="afegir_superadmin">
                                <a href="">Afegir Users Alumnes</a>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </figure>
        </article>

        <article id="3">
            <h1>Consultes.</h1>
            <figure>
                <table role="grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>Exercici</th>
                            <th>Profesor</th>
                            <th>Hora</th>
                            <th>Data</th>
                            <th>Acabada</th>
                            <th>Options</th>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM consultes";
                        $consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));

                        while($consulta = mysqli_fetch_array($consultes)){
                        if(!empty($consulta["id_consulta"])){
                        ?>
                        <tr>
                            <td>
                            <?php
                            echo $consulta["id_consulta"];
                            ?>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM usuarios WHERE id_usuario =".$consulta["usuario_consulta_FK"];
                                $usuarios_consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $usuario_consulta = mysqli_fetch_array($usuarios_consultes);

                                echo $usuario_consulta["nom"]." ".$usuario_consulta["cognom"]
                                ?>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM exercicis WHERE id_exercici=".$consulta["exercici_FK"];
                                $exercicis_consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $exercici_consulta = mysqli_fetch_array($exercicis_consultes);

                                $sql = "SELECT * FROM moduls WHERE id_modul=".$exercici_consulta["modul_FK"];
                                $moduls_consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $modul_consulte = mysqli_fetch_array($moduls_consultes);

                                echo $modul_consulte["modul"]." - ".$modul_consulte["uf"]." - ".$exercici_consulta["exercici"];
                                ?>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM usuarios WHERE id_usuario=".$consulta["profesor_FK"];
                                $profesors_consultes = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $profesor_consulta = mysqli_fetch_array($profesors_consultes);

                                echo $profesor_consulta["nom"]." ".$profesor_consulta["cognom"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $consulta["hora"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $consulta["date"];
                                ?>
                            </td>
                            <td>
                                <?php
                                if($consulta["acabada"]==1){
                                    echo "SI";
                                }else{
                                    echo "NO";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="">Editar</a>
                                <a href="">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                        }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="8" class="afegir_superadmin">
                                <a href="">Afegir Consultes</a>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </figure>
        </article>

        <article id="4">
            <h1>Moduls.</h1>
            <figure>
                <table role="grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Modul</th>
                            <th>UF</th>
                            <th>Profesor</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM moduls";
                        $moduls = mysqli_query($con,$sql) or exit(mysqli_error($con));

                        while($modul = mysqli_fetch_array($moduls)){
                        if (!empty($modul["id_modul"])){
                        ?>
                        <tr>
                            <td>
                                <?php
                                echo $modul["id_modul"]
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $modul["modul"]
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $modul["uf"]
                                ?>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT nom,cognom FROM usuarios WHERE id_usuario=".$modul["profesor"];
                                $noms_profesor = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $nom_profesor = mysqli_fetch_array($noms_profesor);

                                echo $nom_profesor["nom"]." ".$nom_profesor["cognom"];
                                ?>
                            </td>
                            <td>
                                <a href="">Editar</a>
                                <a href="">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                        }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="afegir_superadmin">
                                <a href="">Afegir Moduls</a>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </figure>
        </article>

        <article id="5">
            <h1>Exercicis.</h1>
            <figure>
                <table role="grid">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Exercici</th>
                            <th>Modul</th>
                            <th>Uf</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM exercicis";
                        $exercicis = mysqli_query($con,$sql) or exit(mysqli_error($con));
                        while($exercici = mysqli_fetch_array($exercicis)){;
                        if(!empty($exercici["id_exercici"])){
                        ?>
                        <tr>
                            <td>
                                <?php
                                echo $exercici["id_exercici"]
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $exercici["exercici"]
                                ?>
                            </td>
                            <td>
                                <?php
                                $sql = "SELECT * FROM moduls WHERE id_modul=".$exercici["modul_FK"];
                                $exercicis_moduls = mysqli_query($con,$sql) or exit(mysqli_error($con));
                                $exercici_modul = mysqli_fetch_array($exercicis_moduls);

                                echo $exercici_modul["modul"];
                                ?>
                            </td>
                            <td>
                                <?php
                                echo $exercici_modul["uf"];
                                ?>
                            </td>
                            <td>
                                <a href="">Editar</a>
                                <a href="">Eliminar</a>
                            </td>
                        </tr>
                        <?php
                        }
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="afegir_superadmin">
                                <a href="">Afegir Exercicis</a>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </figure>
        </article

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
