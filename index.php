<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bienvenido al sistema</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
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

        <form class='formLogin' action="login.php" method="post">
            <h3>Login de usuario</h3>
            <input name="usuario" class="form-control form-control-lg inputForm" placeholder="Usuario"><br>
            <input name="clave" type="text" class="form-control form-control-lg inputForm" placeholder="Contraseña"><br>
            <input type="submit" value="Ingresar" class="btn btn-primary">
            <p><a href="create.php">Crear nuevo usuario</a></p>
        </form><br>
    </div>
</body>

</html>