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
    <header>
        <h1>Resolucio de Dubtes.</h1>
    </header>
    <article class="login">
        <h3>Canviar Contraseña de <?php echo $_SESSION["usuario"]?>.</h3>

        <form action="editar_perfil_save.php" method="POST">
            <label for="contrasenya">Contrasenya actual:</label>
            <input name="contraseña" type="text" placeholder="Contrasenya actual" required>
            <label for="contreseña_new">Nova contrasenya:</label>
            <input name="contreseña_new" type="text" placeholder="Nova contrasenya" required>
            <label for="re_contraseña">Repeteix nova contrasenya:</label>
            <input name="re_contraseña" type="re_contraseña" placeholder="Repeteix nova contrasenya" required>
            <button type="submit">Enviar</button>
            <input type="hidden" name=id_usuario value="<?php echo $_SESSION["usuario"]?>">
    </article>
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
</html>