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
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Billetera Virtual</h1>
      </div>
      <div class="text-center">
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
        <h3>Hola <?php echo $nom;?></h3>
        <p> Tu saldo : <?php echo $usuario->getSaldo();?></p>  

        <p><a href="operacion.php">Realizar operación</a></p>
        <p><a href="datos_modificar.php">Modificar mi saldo</a></p>
        <p><a href="confirmar_delete.php" class="btn btn-danger">Eliminar mis datos</a></p>
        <p><a href="logout.php">Cerrar sesión</a></p>
      </div>
    </body>
</html>
