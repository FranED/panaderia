<?php
// Relentizar la respuesta de la base de datos un segundo, para apreciar el cambio de botón
sleep(1);
include('db.php');
session_start();
if (!empty($_REQUEST['nombreUsuario']) && !empty($_REQUEST['passUsuario'])) {
    $alias = $_REQUEST['nombreUsuario'];
    $contrasena = $_REQUEST['passUsuario'];
    // Busco los datos que se han metido en la base de datos para obtener el nombre del trabajador y el tipo
    $consulta = "SELECT * FROM trabajador WHERE Alias = '$alias' and Contraseña = '$contrasena'";
    $resultado = mysqli_query($conexion, $consulta);
    // Si el resultado que obtengo devuelta, tiene 1 coincidencia es; que está en la bd si no, pues no está
    if ($resultado->num_rows == 1) {
        $json = array();
        // Al existir coincidencias, que busque el tipo de usuario que es y lo devuelva
        while ($row = mysqli_fetch_array($resultado)) {
            $json[] = array(
                'tipo' => $row['Tipo']
            );
            // Agrego la sesión al nombre (no al alias) del usuario que entra al sistema
            $_SESSION['usuario'] = $row['Nombre'];
            $_SESSION['cod'] = $row['idTrabajador'];
        }
        $jsonString = json_encode($json);
        echo $jsonString;
    } else {
        echo "No hay coincidencias en la base de datos";
    }
} else {
    echo 'Introducir campos';
}