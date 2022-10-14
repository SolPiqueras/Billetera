<?php
require_once 'entidades/Transaccion.php';
require_once 'controladores/ControladorTransaccion.php';
require_once 'entidades/Cliente.php';
require_once 'entidades/Empresa.php';

session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
} else {
    header('Location: index.php');
}

$empresa = "";
 if(isset($_POST['listaEmpresas'])){
    $empresa= htmlentities($_POST['listaEmpresas']);
}else{
    echo "No funco";
}

if (
    !empty($_POST['monto'])
) {
    
    
    $cs = new ControladorTransaccion();
    $result = $cs->create(
        $_POST['monto'],
        $usuario,
        $empresa 
    );

    $redirigir = 'PagoRealizado.php?mensaje='.$result[1];
} else {
    $mensaje = "No fue posible modificar tus datos.";
    $redirigir = "home.php?mensaje=$mensaje";
}
header("Location: $redirigir");