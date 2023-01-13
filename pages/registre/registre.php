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
        <h3>Registre.</h3>
        <form action="registre_save.php" method="POST">
            <label for="nom">Nom:</label>
            <input name="nom" type="text" placeholder="Nom" required>
            <label for="cognom">Cognom:</label>
            <input name="cognom" type="text" placeholder="Cognom" required>
            <label for="email">Email:</label>
            <input name="email" type="email" placeholder="Email" required>
            <label for="user">User:</label>
            <input name="user" type="text" placeholder="Username" required>
            <label for="pass">Password:</label>
            <input name="pass" type="text" placeholder="Password" required>
            <footer>
                <input type="submit" value="Iniciar sesión">
            </footer>
        </form>
        <footer>
            <p>Ya estas registrat ? <a href="../../index.php">Login.</a></p>
        </footer>
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