<?php include('navbar.php'); ?>
<?php 
require_once 'entidades/Cliente.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nom = $usuario->getNombre();
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <title>Billetera Virtual</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Billetera Virtual</h1>
      </div>    
      <div class="text-center">
        <h3>Pago Realizado con éxito</h3>
        <p><a href="login.php">Cerrar sesión</a></p>
      </div> 
    </body>
</html>
