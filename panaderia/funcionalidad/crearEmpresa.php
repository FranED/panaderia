<?php
include('db.php');
if (isset($_REQUEST['nombre']) && isset($_REQUEST['telefono']) && isset($_REQUEST['comision'])) {
    $codEmpresa = rand(0,20).rand(0,9999).rand(0,9999);
    $nombre = $_REQUEST['nombre'];
    $telefono = $_REQUEST['telefono'];
    $comision = $_REQUEST['comision'];
    $consulta = "INSERT INTO empresa_transporte (idEmpTransporte, Nombre, Teléfono, Comision) VALUES ('$codEmpresa' ,'$nombre','$telefono','$comision')";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die('Error consulta Empresa' . mysqli_error($resultado));
    } else {
        echo 'Empresa agregada';
    }
} else {
    echo 'Rellene todos los datos';
}