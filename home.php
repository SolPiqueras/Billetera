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
        <title>Sistema bancario</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
    </head>
    <body class="container">
      <div class="jumbotron text-center">
      <h1>Sistema bancario</h1>
      </div>    
      <div class="text-center">
        <h3>Hola <?php echo $nom;?></h3>
        <p><a href="logout.php">Cerrar sesión</a></p>
      </div> 
    </body>
</html>
