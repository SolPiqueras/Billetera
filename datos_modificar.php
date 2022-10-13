<?php
require_once 'controladores/ControladorCliente.php';
require_once 'entidades/Cliente.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $saldo = $usuario->getSaldo();

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
        <link rel="stylesheet" href="bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Billetera Virtual</h1>
      </div>
      <div class="text-center">
        <h3>Modifica tu saldo</h3>
        <form action="UpdateController.php" method="post">
            <label for="usuario">Saldo</label>
            <input type="saldo" name="saldo" class="form-control form-control-lg" placeholder="Saldo" value="<?php echo $saldo;?>"><br>
            <input type="submit" value="Modificar saldo" class="btn btn-primary">
        </form>
      </div>
    </body>
</html>
