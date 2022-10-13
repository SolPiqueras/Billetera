<?php include('navbar.php'); ?>
<?php
require_once 'entidades/Cliente.php';
require_once 'entidades/Empresa.php';
session_start();
if (isset($_SESSION['usuario'])) {
  $usuario = unserialize($_SESSION['usuario']);
  $nom = $usuario->getNombre();
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
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script>
        </script>
    </head>
    <body class="container">
        <div class="jumbotron text-center">
            <h1>Ultimas Transacciones</h1>
        </div> 
        <form action="TransactionTableController.php" method="post">
            <div class="table-responsive-lg">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Saldo</th>
                        <th scope="col">Lugar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        </tr>
                    </tbody>
                </table>
            </div>      
        </form>        
      </div>
    </body>
</html>

