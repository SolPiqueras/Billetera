<?php include('navbar.php'); ?>
<?php
require_once 'entidades/Cliente.php';
require_once 'entidades/Empresa.php';
session_start();
if (isset($_SESSION['usuario'])) {
    $usuario = unserialize($_SESSION['usuario']);
    $nom = $usuario->getNombre();
    $userId = $usuario->getId();
} else {
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Sistema bancario</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script>
    </script>
</head>

<body class="container">
    <div class="jumbotron text-center">
        <h1>Informes</h1>
    </div>
        <div class= "d-flex justify-content-center">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Transacción máxima</h5>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Transacción máxima</th>
                                        <th scope="col">Fecha</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php
                                        $usuario = 'root';
                                        $password = 'npEGa2014'; // cuidado, aca va el password db local de c/u
                                        $db = new PDO('mysql:host=localhost;dbname=Billetera', $usuario, $password);
                                        $query = $db->prepare("SELECT MAX(montoTransaccion) AS PrecioMax, C.nombreCliente AS Nombre, fechaTransaccion AS fecha FROM billetera.transacciones T INNER JOIN billetera.clientes C WHERE T.clientes_idCliente = C.dniCliente ;
                                        ");
                                        $query->execute();
                                        $data = $query->fetchAll();
                                        foreach ($data as $valores) :
                                            echo '<tr>';
                                            echo '<th scope="row">' . $valores["Nombre"] . '</th>';
                                            echo '<th scope="row">' . $valores["PrecioMax"] . '</th>';
                                            echo '<th scope="row">' . $valores["fecha"] . '</th>';
                                            echo '</tr>';
                                        endforeach;
                                        ?>
                                    </tbody>
                            </table>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
</body>

</html>