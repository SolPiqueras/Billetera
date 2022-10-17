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
  <div class=titleContainer" style="text-align: center;font-size: 35px;color: white;">
    <h1 style="font-size: 31px;margin: 5% auto;font-weight: bold;"> Pago realizado con éxito</h1>
  </div>
  <div class="text-center">
    <p><a href="login.php">Cerrar sesión</a></p>
  </div>
</body>

</html>