<?php
require_once 'controladores/ControladorCliente.php';
require_once 'controladores/ControladorEmpresa.php';

if (isset($_POST['id']) && isset($_POST['clave'])) {
    if ($_POST['tipo'] === 'cliente1') {
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
    <link rel="stylesheet" href="./css/form.css">
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

        function valideKey(evt) {

            // code is the decimal ASCII representation of the pressed key.
            var code = (evt.which) ? evt.which : evt.keyCode;

            if (code == 8) { // backspace.
                return true;
            } else if (code >= 48 && code <= 57) { // is a number.
                return true;
            } else { // other keys.
                return false;
            }
        }
    </script>
</head>

<body class="container">
    <div class=titleContainer" style="text-align: center;font-size: 25px;color: white;">
        <h1>Billetera Virtual</h1>
    </div>
    <div class="text-center" style="width: 30%;margin: auto;">
        <?php
        if (isset($_GET['mensaje'])) {
            echo '<div id="mensaje" class="alert alert-primary text-center">
            <p>' . $_GET['mensaje'] . '</p></div>';
        }
        ?>

        <form method="post">
            <h1 style="color: #fff;text-shadow: 0 0 10px rgba(0,0,0,0.3);letter-spacing: 1px;text-align: center;">Registro</h1>
            <input type="text" name="id" id="id" placeholder="Usuario" required="required" />
            <input type="password" name="clave" placeholder="Contraseña" required="required" />
            <input type="text" name="nombre" placeholder="Nombre" required="required" />
            <input type="number" name="saldo" id="saldo" min="0" onkeypress="return valideKey(event)" placeholder="Saldo" required="required" />
            <input type="text" name="domicilio" placeholder="Domicilio"" required=" required" />
            <div class="parentContainer">
                <select name="tipo" id="" style="margin: 3% auto;height: 30px;background-color: #05050545;border: none;border-radius: 4px;width: 33%;color: #ffffffa6;">
                    <option value="cliente1">Cliente</option>
                    <option value="empresa1">Empresa</option>
                </select>
            </div>
            <button type="submit" value="Registrarse" class="btn btn-primary btn-block btn-large">Registrarse</button>
        </form>

    </div>
</body>

</html>