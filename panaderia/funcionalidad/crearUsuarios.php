<?php
include('db.php');
if (!empty($_REQUEST['nombreUsuario']) && !empty($_REQUEST['passUsuario']) && !empty($_REQUEST['tipUsuario'] && !empty($_REQUEST['alias']))) {
    //Paso a minuscula el tipo de usuario    
    $tipoUsuario = strtolower($_REQUEST['tipUsuario']);
    //Impongo que tiene que ser igual a jefe o trabajador, fuera de eso. No se guardaría el usuario
    if ($tipoUsuario == 'jefe' || $tipoUsuario == 'trabajador') {
        $nombre = $_REQUEST['nombreUsuario'];
        $contrasena = $_REQUEST['passUsuario'];
        $alias = $_REQUEST['alias'];
        // Vamos a gener los codigos de manera que sea imposible de que se dupliquen en la bd
        // Concateno la hora actual en segundo y un numero entero comprendido en el [1,32786]
        $cod = rand(0, 20) . rand(0, 9999) . rand(0, 9999);
        $consulta = "INSERT INTO trabajador (idTrabajador, Nombre, Contraseña, Tipo, Alias) VALUES ('$cod','$nombre','$contrasena','$tipoUsuario','$alias')";
        $resultado = mysqli_query($conexion, $consulta);
        if (!$resultado) {
            die("Usuario no agregado correctamente" . mysqli_error($conexion));
        } else {
            echo 'Usuario agregado';
        }
    } else {
        echo 'Usuario: Jefe o Trabajador';
    }
} else {
    echo 'Rellene los datos de los campos';
}
