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
        <h1>Informes sobre transacciones</h1>
        <form action="informes.php" method="POST">
            <input type="submit" name = "min" value="Mostrar mínima" class="btn btn-primary">
            <input type="submit" name = "max" value="Mostrar máxima" class="btn btn-light">
        </form>
    </div>
        <div class= "d-flex px-0 justify-content-center ">            
            
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">                        
                        <?php                            
                            if (isset($_REQUEST['max'])){
                                $muestra1 = '<div class="card-body " style="width: 33rem;>
                                            <h2 class="card-title">Transacción máxima</h2>';
                                $col = '<th scope="col">Transacción máxima</th>';
                                $pedido = "MAX";
                            }else if (isset($_REQUEST['min'])){
                                $muestra1 = '<div class="card-body " style="width: 33rem;>
                                            <h2 class="card-title">Transacción mínima</h2>';
                                $col = '<th scope="col">Transacción mínima</th>';
                                $pedido = "MIN";
                            }else{
                                $muestra1 = '<div class="card-body " style="width: 33rem; display: none;">';
                            }
                            echo "$muestra1";
                            ?>          
                            <!-- <h5 class="card-title">Transacción máxima</h5> -->
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Cliente</th>
                                        <?php echo "$col"; ?>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Empresa</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php
                                        $usuario = 'root';
                                        $password = 'npEGa2014'; // cuidado, aca va el password db local de c/u
                                        $db = new PDO('mysql:host=localhost;dbname=Billetera', $usuario, $password);
                                        $query = $db->prepare("SELECT $pedido(montoTransaccion) AS PrecioMax, C.nombreCliente AS NombreC, E.nombreEmpresa AS NombreE, fechaTransaccion AS fecha FROM billetera.transacciones T INNER JOIN billetera.clientes C INNER JOIN billetera.empresas E WHERE T.clientes_idCliente = C.dniCliente AND E.cuitEmpresa = T.empresas_idEmpresa ;
                                        ");
                                        $query = $db->prepare(SELECT montoTransaccion AS PrecioMax, C.nombreCliente AS NombreC, E.nombreEmpresa AS NombreE, fechaTransaccion AS fecha FROM billetera.transacciones T INNER JOIN billetera.clientes C INNER JOIN billetera.empresas E WHERE T.clientes_idCliente = C.dniCliente AND E.cuitEmpresa = T.empresas_idEmpresa AND montoTransaccion=(SELECT max(montoTransaccion) FROM transacciones);
                                        $query->execute();
                                        $data = $query->fetchAll();
                                        foreach ($data as $valores) :
                                            echo '<tr>';
                                            echo '<th scope="row">' . $valores["NombreC"] . '</th>';
                                            echo '<th scope="row">' . $valores["PrecioMax"] . '</th>';
                                            echo '<th scope="row">' . $valores["fecha"] . '</th>';
                                            echo '<th scope="row">' . $valores["NombreE"] . '</th>';
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