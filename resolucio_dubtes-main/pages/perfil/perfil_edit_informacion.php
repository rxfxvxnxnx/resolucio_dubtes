<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acutualizacion Contraseña</title>

    <link rel="shortcut icon" href="../img/icon.png" type="image/x-icon">
    
    <link rel="stylesheet" href="../../css/pico.min.css">
    <link rel="stylesheet" href="../../css/style.css">
</head>
<body class="container">
    <h1 class="marginTop">
    <?php
session_start();

if (empty($_SESSION["usuario"])) {
    header("Location: ../../index.php");
    exit();
}

define('DB_HOST', 'localhost');
define('DB_USER', 'rduart');
define('DB_PASSWORD', 'u8EnMnxo#');
define('DB_NAME', 'rduart');

class Database
{
    private $connection;

    public function __construct()
    {
        $this->connection = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or exit(mysqli_connect_error());
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

$database = new Database();
$con = $database->getConnection();

$stmt = $con->prepare("SELECT * FROM usuarios WHERE usuario = ?");
$stmt->bind_param("s", $_SESSION["usuario"]);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_array();

$nom = filter_var($_POST["nom"], FILTER_SANITIZE_SPECIAL_CHARS);
$cognom = filter_var($_POST["cognom"], FILTER_SANITIZE_SPECIAL_CHARS);
$usuario = filter_var($_POST["usuario"], FILTER_SANITIZE_SPECIAL_CHARS);

//Check if the new username is the same as the current session username
if($usuario === $_SESSION["usuario"]) {
    $stmt = $con->prepare("UPDATE usuarios SET nom = ?, cognom = ? WHERE usuario = ?");
    $stmt->bind_param("sss", $nom, $cognom, $usuario);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "La informacion del perfil se ha actualizado correctamente";
    } else {
        echo "Ha ocurrido un error al actualizar la información del perfil";
    }
    $stmt->close();
} else {
    //Check if there is another user with the same username
    $stmt = $con->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        echo "Ya existe un usuario con ese nombre de usuario, por favor elige otro.";
    } else {
        $stmt = $con->prepare("UPDATE usuarios SET nom = ?, cognom = ?, usuario = ? WHERE usuario = ?");
        $stmt->bind_param("ssss", $nom, $cognom, $usuario, $_SESSION["usuario"]);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo "La informacion del perfil se ha actualizado correctamente";
            $_SESSION["usuario"] = $usuario;
        } else {
            echo "Ha ocurrido un error al actualizar la información del perfil";
        }
        $stmt->close();
    }
}
$con->close();
?>

    </h1>
    <a href="./perfil_edit.php"><button>Tornar</button></a>
</body>
</html>