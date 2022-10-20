<?php include('navbar.php'); ?>
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
    <link rel="stylesheet" href="./css/confirmarDelete.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="container">
    <div class=titleContainer" style="text-align: center;font-size: 35px;color: white;">
        <h1 style="font-size: 31px;margin: 5% auto;font-weight: bold;">Eliminar cuenta</h1>
    </div>
    <div class="text-center" style="width: 40%;margin: auto;">
        <div class="text-center">
            <div id="mensaje" class="alert alert-danger text-center">
                <p>Advertencia. Ud va a ELIMINAR su usuario.
                    Esta acción no se puede deshacer.</p>
            </div>

            <form action="DeleteController.php" method="post">
                <label style="color: white;" for="usuario">Escriba su nombre de usuario para <strong>eliminar</strong> su cuenta: </label><br>
                <input type="text" name="usuario" placeholder="Usuario" required="required" />
                <input type="submit" value="Eliminar usuario" class="btn btn-primary btn-block btn-large" style="margin: 8% auto;width: 55%;">
            </form>
        </div>
</body>

</html>