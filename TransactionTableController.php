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
    <title>Billetera Virtual</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/tableTransactions.css">
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script>
    </script>
</head>

<body class="container">
    <!-- <div class="jumbotron text-center">
        <h1>Ultimas Transacciones</h1>
    </div> -->
    <div class=titleContainer" style="text-align: center;font-size: 35px;color: white;">
        <h1 style="font-size: 31px;margin: 5% auto;font-weight: bold;">Últimas Transacciones</h1>
    </div>
    <form action="TransactionTableController.php" method="post">
        <div class="table-responsive-lg">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Empresa</th>
                        <th scope="col">Fecha transacción</th>
                        <th scope="col">Monto transacción</th>
                    </tr>
                </thead>
                <!-- <tbody class="" id="fetch-transaction-petition"></tbody> -->
                <tbody>
                    <!-- <tr> -->
                    <?php
                    $usuario = 'root';
                    $password = 'password'; // cuidado, aca va el password db local de c/u
                    $db = new PDO('mysql:host=localhost;dbname=Billetera', $usuario, $password);
                    $query = $db->prepare("SELECT * FROM transacciones WHERE clientes_idCliente = $userId");
                    $query->execute();
                    $data = $query->fetchAll();
                    foreach ($data as $valores) :
                        echo '<tr>';
                        echo '<th scope="row">' . $valores["idTransaccion"] . '</th>';
                        echo '<td>' . $valores["empresas_idEmpresa"] . '</td>';
                        echo '<td>' . $valores["fechaTransaccion"] . '</td>';
                        echo '<td>' . $valores["montoTransaccion"] . '</td>';
                        echo '</tr>';
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
    </form>
    </div>
</body>

</html>