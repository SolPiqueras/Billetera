<?php include('navbar.php'); ?>
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
        <title>Sistema bancario</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script>
            function maxLengthCheck(object){
                if (object.value > object.maxLength){
                    object.value = object.maxLength
                }
            }
            function isNumeric (evt) {
                var theEvent = evt || window.event;
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode (key);
                var regex = /[0-9]|\./;
                if ( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
                }
            }
        </script>
    </head>

<body class="container">
    <div class="jumbotron text-center">
        <h1>Operaciones Financieras</h1>
    </div>
    <?php
            if (isset($_GET['mensaje'])) {
                echo '<div id="mensaje" class="alert alert-primary text-center">
                    <p>'.$_GET['mensaje'].'</p></div>';
            }
        ?>
    <div class="d-flex justify-content-center">
        <form action="datos_modificar.php" method="post">
            <div class="card" style="width: 28rem;">
                <div class="card-body">
                    <h5 class="card-title">Tu saldo actual es: <?php echo $usuario->getSaldo();?></h5>
                    <h6 class="card-subtitle mb-2 text-muted">Transferir</h6>
                    <input type="number" name="saldo" id="saldo" class="form-control form-control-lg" min="0"
                        maxlength=<?php echo strval($usuario->getSaldo()); ?> oninput="maxLengthCheck(this)" onkeypress="return isNumeric(event)"
                        placeholder="Saldo"><br>
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
                    <p><a href="confirmar_delete.php" class="btn btn-danger">Eliminar mis datos</a></p>
                </div>
            </div>
        </form>
    </div>
    </div>
</body>
</html>