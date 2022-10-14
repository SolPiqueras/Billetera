<?php include('navbar.php'); ?>
<?php
require_once 'controladores/ControladorTransaccion.php';
require_once 'entidades/Transaccion.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $monto = $usuario->getMonto();

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
        <h1>Operaciones Financieras</h1>
    </div>
    <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
    <div class="d-flex justify-content-center">
        <form action="Transaccion.php" method="post">
            <div class="card" style="width: 28rem;">
                <div class="card-body">
                    <h5 class="card-title">Tu saldo actual es: <?php echo $usuario->getSaldo();?></h5>
                    <input type="monto" name="monto" class="form-control form-control-lg" placeholder="Monto" value="<?php echo $monto;?>"><br>
                    <input type="submit" value="Recargar" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
    </div>
</body>
</html>