<?php
require_once 'controladores/ControladorCliente.php';
require_once 'controladores/ControladorEmpresa.php';

if (isset($_POST['cliente']) && isset($_POST['id']) && isset($_POST['clave'])) {
    $cs = new ControladorCliente();
    $result = $cs->create(
        $_POST['id'],
        $_POST['nombre'],
        $_POST['saldo'],
        $_POST['clave']
    );
    if ($result[0] === true) {
        $redirigir = 'home.php?mensaje=' . $result[1];
    } else {
        $redirigir = 'create.php?mensaje=' . $result[1];
    }
    header('Location: ' . $redirigir);
} else {
    if (isset($_POST['id']) && isset($_POST['clave'])) {
        $cs = new ControladorEmpresa();
        $result = $cs->create(
            $_POST['id'],
            $_POST['nombre'],
            $_POST['saldo'],
            $_POST['domicilio'],
            $_POST['clave']
        );
        if ($result[0] === true) {
            $redirigir = 'home.php?mensaje=' . $result[1];
        } else {
            $redirigir = 'create.php?mensaje=' . $result[1];
        }
        header('Location: ' . $redirigir);
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bienvenido al sistema</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>
    <script>
        jQuery(function($) {
            $("#id").mask("99-999999");
            $('input[type="checkbox"]').on('change', function() {
                $(this).siblings('input[type="checkbox"]').prop('checked', false);
            });
        });
    </script>
</head>

<body class="container">
    <div class="jumbotron text-center titleContainer">
        <h1>Billetera Virtual</h1>
    </div>
    <div class="text-center">
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje" class="alert alert-primary text-center">
            <p>' . $_GET['mensaje'] . '</p></div>';
        }
        ?>

<form class="form" action="create.php" method="post">
            <h3>Crear nuevo usuario</h3>
            <input type="text" name="id" id="id" class="form-control form-control-lg inputForm" placeholder="Usuario"><br>
            <input type="password" name="clave" type="password" class="form-control form-control-lg inputForm" placeholder="Contraseña"><br>
            <input type="text" name="nombre" class="form-control form-control-lg inputForm" placeholder="Nombre"><br>
            <input type="number" name="saldo" id="saldo" class="form-control form-control-lg inputForm" min="0" onkeypress="return isNumeric(event)" placeholder="Saldo"><br>
            <input type="text" name="domicilio" class="form-control form-control-lg inputForm" placeholder="Domicilio"><br>
            <div class="parentContainer">
                <div class="radioContainer"><input type="checkbox" name="cliente" value="cliente">Cuenta personal</div>
                <div class="radioContainer"><input type="checkbox" name="empresa" value="empresa">Cuenta empresarial</div>
            </div>
            <input type="submit" value="Registrarse" class="btn btn-primary">
        </form>
    </div>
</body>

</html>