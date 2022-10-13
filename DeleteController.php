<?php
session_start();

require_once 'entidades/Cliente.php';
require_once 'controladores/ControladorCliente.php';

if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}

if (empty($_POST['usuario']) || $_POST['usuario'] != $usuario->getId()) {
    header("Location: home.php?mensaje=Error al eliminar el usuario");
    die();
}

$cs = new ControladorCliente();

$result = $cs->eliminar($usuario);
$redirigir = 'index.php?mensaje='.$result[1];

session_destroy();
header("Location: $redirigir");
