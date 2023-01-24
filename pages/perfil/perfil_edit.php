<?php
session_start();
if (empty($_SESSION["usuario"])) {
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
    <title>Resolució de Dubtes</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container">
    <?php
        $con = mysqli_connect("localhost","rduart","u8EnMnxo#","rduart") or exit(mysqli_connect_error());
        $sql = "SELECT * FROM usuarios WHERE usuario = '".$_SESSION["usuario"]."'";
        $usuarios_foto = mysqli_query($con,$sql) or exit(mysqli_error($con));
        $usuario_foto = mysqli_fetch_array($usuarios_foto);

        if ($usuario_foto["perfil_img"] == "") {
            $foto_perfil = "default.png";
        } else {
            $foto_perfil = $usuario_foto["perfil_img"];
        }
    ?>
    <header>
        <nav>
            <ul>
                <li><a class="secondary pointer" onclick="mostrar()"><img src="../../img/menu_icon.png" alt="" width="30px"></a></li>
            </ul>
            <ul>
                <li><strong class="title"><?php echo $_SESSION["usuario"] ?>.</strong></li>
            </ul>      
            <details role="list" dir="rtl">
                <summary><img class="profile" src="../../img/user_img/<?php echo $foto_perfil ?>"></summary>
                <ul>
                    <?php
                    if ($_SESSION["permis"]==2){
                        $link = "../../lista.php";
                    }else {
                        $link = "../../pages/admin/admin.php";
                    }
                    ?>
                    <li><a href="../../pages/solucio/solucio.php">Solucions Busqueda</a></li>
                    <li><a href="<?php echo $link ?>">Resolucio Dubtes</a></li>
                    <li><a href="../../php/logout.php">Logout</a></li>
                </ul>
            </details>
        </nav>
        <aside id="menu">
            <nav class="menu_desple">
                <li><h4><a href="#1" onclick="guardar()">Canviar Foto</a></h4></li>
                <li><h4><a href="#2" onclick="guardar()">Canviar Informacio</a></h4></li>
                <li><h4><a href="#3" onclick="guardar()">Canviar Contraseña</a></h4></li>
                </ul>
            </nav>
        </aside>
    </header>
    <main>
        <article id="1">
            <h1>Canviar Foto de Perfil.</h1>
        
            <div class="canvi_fotoPerfil">
                <img src="../../img/user_img/<?php echo $foto_perfil ?>" alt="">
            </div>
            <div class="formFoto">
                <form action="perfil_edit_save_foto.php" method="post" enctype="multipart/form-data" class="grid">
                    <input type="file" id="foto_perfil" name="foto_perfil">
                    <button type="submit">Subir Archivo</button>
                </form>
            </div>
        </article>
        <article id="2">
            <h1>Canviar Informacio.</h1>

        </article>
        <article id="3">
            <h1>Canviar Contraseña.</h1>

            <form action="editar_perfil_save.php" method="POST">
                <label for="contrasenya">Contrasenya Actual:
                    <input name="contraseña" type="text" placeholder="Contrasenya actual" required>
                </label>

                <label for="contreseña_new">Nova Contrasenya:
                    <input name="contreseña_new" type="text" placeholder="Nova contrasenya" required>
                </label>
                
                <label for="re_contraseña">Repeteix Nova Contrasenya:
                    <input name="re_contraseña" type="re_contraseña" placeholder="Repeteix nova contrasenya" required>
                </label>

                <button type="submit">Enviar</button>
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

<script src="../../js/script.js"></script>
</html>