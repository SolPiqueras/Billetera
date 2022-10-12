<?php
require_once 'controladores/ControladorSesionCliente.php';
require_once 'controladores/ControladorSesionEmpresa.php';

if (empty($_POST['usuario']) || empty($_POST['clave'])) {
    $redirigir = 'index.php?mensaje=Error: Falta un campo obligatorio';
} else {
    $cs = new ControladorSesionCliente();
    $login = $cs->login($_POST['usuario'], $_POST['clave']);
    if ($login[0] === true) {
        $redirigir = 'home.php';
    } else {
        $redirigir = 'index.php?mensaje=' . $login[1];
    }
}
header('Location: '.$redirigir);
