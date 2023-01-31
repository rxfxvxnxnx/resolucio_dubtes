<?php
session_start();
if (empty($_SESSION["usuario"]) || $_SESSION["permis"] == 2) {
    header("Location: ../../lista.php");
    exit();
}
?>

<?php
$id_modul = $_REQUEST["id_modul_crear"];
?>

<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolucio de Dubtes</title>

    <link rel="shortcut icon" href="../../img/icon.png" type="image/x-icon">
    <link rel="stylesheet" href="../../style.css">
    <link rel="stylesheet" href="../../css/pico.min.css">
</head>
<body class="container">             
        <article>
            <h1>Afegir nou exercici.</h1>
            <form action="exercicis_create_save.php?id_modul=<?php echo $id_modul ?>" method="POST">
            <label for="nou_exercici">Nom Exercici:</label>
                <input name="nou_exercici" id="nou_exercici" type="text">
                <input type="submit" value="Enviar" role="button" class="boto">
            </form>
        </article>
    </main>
</body>
</html>