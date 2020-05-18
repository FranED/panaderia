<?php
include('db.php');

if (isset($_REQUEST['nombre']) && isset($_REQUEST['telefono']) && isset($_REQUEST['direccion'])) {
    $cod = rand(0, 20) . rand(0, 9999) . rand(0, 9999);
    $nombre = $_REQUEST['nombre'];
    $telefono = $_REQUEST['telefono'];
    $direccion = $_REQUEST['direccion'];
    $consulta = "INSERT INTO proveedores (idProveedor, Nombre, Telefono, Direccion) VALUES ('$cod','$nombre','$telefono','$direccion')";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die('Proveedor no agregado');
    } else {
        echo 'Proveedor agregado';
    }
} else {
    echo 'Introduzca todos los campos';
}
