<?php
// Inicio de la sesión
session_start();
// Recupero la sesión asignada en este caso al nombre del usuario
if (isset($_SESSION['tipo'])) {
    $tipo = $_SESSION['tipo'];
    // En el caso de no existir usuario, que valla al loggin
    if ($tipo == "Jefe") {
        header('location: index.php');
    } else if ($tipo == "Trabajador") {
        header('location: panaderia.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://bootswatch.com/4/sketchy/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../css/login.css">
    <script src="../js/js.js"></script>
</head>

<body>
    <header>
        <div class="container">
            <div class="jumbotron">
                <h1>Panaderia Virtu@l</h1>
                <h3>Proyecto FIN. Desarrollo de Aplicaciones Web</h3>
            </div>
        </div>
    </header>
    <section>
        <div class="container" id="login">
            <div class="row">
                <div class="col-6 offset-1">
                    <form id="formLogin">
                        <h5>Acceso al sistema</h5>
                        <div class="form-group">
                            <input type="text" id="nombreInicio" class="form-control" placeholder="Alias *" required>
                        </div>
                        <div class="form-group">
                            <input type="password" id="passInicio" class="form-control" placeholder="Contraseña *" required>
                        </div>
                        <div class="form-group boton">
                            <img src="../imagenes/panadero.png" alt="panadero">
                            <input type="submit" class="btn btn-success btn-lg" id="btnValidar" value="Entrar">
                            <div class="error"></div>
                        </div>
                    </form>
                </div>
                <div class="offset-1 col-4 login">
                    <img src="../imagenes/fondo.png" alt="pan">
                </div>
    </section>
    </div>
    <footer class="page-footer">
        <p>Copyright 2020</p>
        <p>Francisco Carlos del Pino Gallardo</p>
    </footer>
</body>

</html>