<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bienvenido al sistema</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <div class="titleContainer" style="text-align: center;font-size: 25px;color: white;">
        <h1>Billetera Virtual</h1>
    </div>

    <!-- 
        <form class='formLogin' action="login.php" method="post">
            <h3>Login de usuario</h3>
            <input name="usuario" class="form-control form-control-lg inputForm" placeholder="Usuario"><br>
            <input name="clave" type="password" class="form-control form-control-lg inputForm" placeholder="Contraseña"><br>
            <input type="submit" value="Ingresar" class="btn btn-primary">
            <p><a href="create.php">Crear nuevo usuario</a></p>
        </form><br> -->
    <div class="login">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <input type="text" name="usuario" placeholder="Usuario" maxlength="11" required="required" />
            <input type="password" name="clave" placeholder="Contraseña" required="required" />
            <button type="submit" value="Ingresar" class="btn btn-primary btn-block btn-large">Ingresar</button>
            <p><a href="create.php" style="color: white;">Crear nuevo usuario</a></p>
        </form>
    </div>
    </div>
</body>

</html>