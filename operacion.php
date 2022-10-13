<?php
require_once 'entidades/Cliente.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nom = $usuario->getNombre();
} else {
    header('Location: operacion.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Realizar operación</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body class="container">
    <div class="jumbotron text-center">
        <h1>Realizar operación</h1>
    </div>
    <div class="text-center">
        <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
        <h3>Hola <?php echo $nom;?></h3>
        <p> Tu saldo: <?php echo $usuario->getSaldo();?></p>

        <form action="datos_modificar.php" method="post">
            <h1>OPERACION</h1>
            <input name="fecha" type="date" class="form-control form-control-lg" placeholder="Fecha"><br>
            <input name="monto" type="text" class="form-control form-control-lg" placeholder="Monto"><br>
            <p>Empresas:
                <select>
                    <option value="0">Seleccione:</option>
                        <?php
                            $usuario = 'root';
                            $password = 'root';
                            $db = new PDO('mysql:host=localhost;dbname=Billetera', $usuario, $password);
                            $query = $db->prepare("SELECT nombreEmpresa FROM empresas");
                            $query->execute();
                            $data = $query->fetchAll();

                            foreach ($data as $valores):
                                echo '<option value="'.$valores["cuitEmpresa"].'">'.$valores["nombreEmpresa"].'</option>';
                            endforeach;
                        ?>
                </select>
            </p>
            <input type="submit" name="Comprar" value="Comprar" class="btn btn-primary">
            <input type="submit" name="Añadir Saldo" value="Añadir Saldo" class="btn btn-primary">
        </form>
        <p><a href="confirmar_delete.php" class="btn btn-danger">Eliminar mis datos</a></p>

    </div>
</body>

</html>