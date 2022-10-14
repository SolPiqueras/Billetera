<?php

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bienvenido al sistema</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="container">
    <div class="jumbotron text-center titleContainer">
        <h1>Billetera Virtual</h1>
    </div>
    <div class="text-center">
        <div id="mensaje" class="alert alert-danger text-center">
        <p>Advertencia. Ud va a ELIMINAR su usuario.
                Esta acción no se puede deshacer.</p>
        </div>

        <form action="DeleteController.php" method="post">
            <label for="usuario">Escriba su nombre de usuario para <strong>eliminar</strong> su cuenta: </label><br>
            <input name="usuario" class="form-control form-control-lg inputForm confirmInput" placeholder="Usuario"><br>
            <input type="submit" value="Eliminar usuario" class="btn btn-primary btnConfirm">
        </form>
    </div>
</body>

</html>