<?php
include('db.php');
if (isset($_REQUEST['nombre']) && isset($_REQUEST['telefono']) && isset($_REQUEST['direccion'])) {
    $codCliente = rand(0,20).rand(0,9999).rand(0,9999);
    $nombre = $_REQUEST['nombre'];
    $telefono = $_REQUEST['telefono'];
    $direccion = $_REQUEST['direccion'];
    $consulta = "INSERT INTO clientes (idCliente, Nombre, Telefono, Direccion) VALUES ('$codCliente' ,'$nombre','$telefono','$direccion')";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die('Error consulta clientes');
    } else {
        echo 'Cliente agregado';
    }
} else {
    echo 'Rellene todos los datos';
}
