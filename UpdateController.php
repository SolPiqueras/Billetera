<?php
require_once 'entidades/Cliente.php';
require_once 'controladores/ControladorCliente.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}

if (
    !empty($_POST['saldo'])
) {
    $cs = new ControladorCliente();
    $result = $cs->recargar(
        $_POST['saldo'],
        $usuario
    );

    $redirigir = 'home.php?mensaje='.$result[1];
} else {
    $mensaje = "No fue posible modificar tus datos.";
    $redirigir = "home.php?mensaje=$mensaje";
}
header("Location: $redirigir");
