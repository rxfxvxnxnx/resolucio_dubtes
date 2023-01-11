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
    <header>
        <h1>Resolucio de Dubtes.</h1>
    </header>
    <article class="login">
        <h3>Login.</h3>
        <form action="php/login.php" method="POST">
            <label for="user">User:</label>
            <input name="user" type="text" placeholder="Username">
            <label for="pass">Password:</label>
            <input name="pass" type="password" placeholder="Password">
            <footer>
                <input type="submit" value="Iniciar sesión">
            </footer>
        </form>
        <footer>
            <p>Si encara no estas registrat. <a href="pages/registre/registre.php">Registrat.</a></p>
        </footer>
    </article>
    <footer>
        
    </footer>
</body>
</html>