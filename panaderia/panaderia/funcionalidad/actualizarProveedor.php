<?php
include('db.php');

if (isset($_REQUEST['cod']) && isset($_REQUEST['nombre']) && isset($_REQUEST['telefono']) && isset($_REQUEST['direccion']) ) {
    
    $cod = $_REQUEST['cod'];
    $nombre = $_REQUEST['nombre'];
    $telefono = $_REQUEST['telefono'];
    $direccion = $_REQUEST['direccion'];
    $consulta = "UPDATE proveedores SET Nombre = '$nombre', Telefono = '$telefono', Direccion = '$direccion' WHERE idProveedor = '$cod'";
    
    $resultado = mysqli_query($conexion, $consulta);
   
    if (!$resultado) {
        die('Consulta fallida');
    }
    echo 'Proveedor actualizado';
}