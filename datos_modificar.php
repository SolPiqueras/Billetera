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
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body class="container">
    <div class="jumbotron text-center">
        <h1>Operaciones Financieras</h1>
    </div>
    <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
    <div class="d-flex justify-content-center">
        <form action="UpdateController.php" method="post">
            <div class="card" style="width: 28rem;">
                <div class="card-body">
                    <h5 class="card-title">Tu saldo actual es: <?php echo $usuario->getSaldo();?></h5>
                    <input type="saldo" name="saldo" class="form-control form-control-lg" placeholder="Saldo" value="<?php echo $saldo;?>"><br>
                    <input type="submit" value="Recargar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
