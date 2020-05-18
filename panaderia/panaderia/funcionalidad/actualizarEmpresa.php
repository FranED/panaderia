<?php

include('db.php');
if (isset($_REQUEST['cod']) && isset($_REQUEST['nombre']) && isset($_REQUEST['telefono']) && isset($_REQUEST['comision'])) {
    $cod = $_REQUEST['cod'];
    $nombre = $_REQUEST['nombre'];
    $telefono = $_REQUEST['telefono'];
    $comision = $_REQUEST['comision'];
    $consulta = "UPDATE empresa_transporte SET Nombre = '$nombre', Teléfono = '$telefono', Comision = '$comision' WHERE idEmpTransporte = '$cod'";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die('Consulta fallida');
    }
    echo 'Empresa actualizada';
}else{
    echo 'Meter todos los datos';
}
