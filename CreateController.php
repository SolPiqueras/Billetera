<?php
require_once 'controladores/ControladorSesionCliente.php';
require_once 'controladores/ControladorSesionEmpresa.php';

if (isset($_POST['cliente']) && isset($_POST['id']) && isset($_POST['clave'])){
        $cs = new ControladorSesionCliente();
        $result = $cs->create($_POST['id'], $_POST['nombre'], 
                              $_POST['saldo'], $_POST['clave']);
        if( $result[0] === true ) {
            $redirigir = 'home.php?mensaje='.$result[1];
        } else {
            $redirigir = 'create.php?mensaje='.$result[1];
        }
        header('Location: ' . $redirigir);
}else{
    if (isset($_POST['id']) && isset($_POST['clave'])) {
        $cs = new ControladorSesionEmpresa();
        $result = $cs->create($_POST['id'], $_POST['nombre'], 
                              $_POST['saldo'], $_POST['domicilio'], $_POST['clave']);
        if( $result[0] === true ) {
            $redirigir = 'home.php?mensaje='.$result[1];
        } else {
            $redirigir = 'create.php?mensaje='.$result[1];
        }
        header('Location: ' . $redirigir);
    }
}

?><!DOCTYPE html> 
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
        <h3>Crear nuevo usuario</h3>
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>

        <form action="create.php" method="post">
            <input name="id" class="form-control form-control-lg" placeholder="Usuario"><br>
            <input name="clave" type="password" class="form-control form-control-lg" placeholder="Contraseña"><br>
            <input name="nombre" class="form-control form-control-lg" placeholder="Nombre"><br>
            <input name="saldo" class="form-control form-control-lg" placeholder="saldo"><br>
            <input name="domicilio" class="form-control form-control-lg" placeholder="domicilio"><br>
            <input type="radio" name="cliente" value="cliente">Cuenta personal
            <input mask type="radio" name="empresa" value="empresa">Cuenta empresarial
            <input type="submit" value="Registrarse" class="btn btn-primary">
        </form>        
      </div> 
    </body>
</html>
