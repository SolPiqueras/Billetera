<?php include('navbar.php'); ?>
<?php
require_once 'entidades/Cliente.php';
require_once 'entidades/Empresa.php';
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
  <link rel="stylesheet" href="./css/home.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body class="container">
  <div class="jumbotron text-center titleContainer prueba">
    <h1>Bienvenido/a</h1>
  </div>
  <div class="text-center">
    <h3>Hola <?php echo $nom; ?></h3>
    <?php
    if (isset($_GET['mensaje'])) {
        echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>' . $_GET['mensaje'] . '</p></div>';
    }
    ?>
    <p><a href="logout.php">Cerrar sesión</a></p>
    <p><a href="confirmar_delete.php" class="btn btn-danger r btnEliminarDatos">Eliminar mis datos</a></p>
  </div>
</body>

</html>