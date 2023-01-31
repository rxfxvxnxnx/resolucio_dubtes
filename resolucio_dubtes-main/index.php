<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Resolució de Dubtes</title>

    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="css/pico.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="container">
    <header>
        <h1>Resolucio de Dubtes.</h1>
    </header>
    <article class="login">
        <h3>Login.</h3>
        <form action="php/login.php" method="POST">
            <label for="user">User:</label>
            <input name="user" type="text" placeholder="Username">
            <div>
            <label>Contraseña</label>
            <input type="password" id="contraseña" name="password" placeholder="Ingresa tu Contraseña" required>
            </div>
            <footer>
                <input type="submit" value="Iniciar Sesión">
            </footer>
        </form>
        <footer>
            <p>Si encara no estas registrat. <a href="pages/registre/registre.php">Registrat.</a></p>
        </footer>
    </article>

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
    <script src="./js/script.js"></script>
</body>
</html>