<?php
include('db.php');
$buscarDireccion = $_REQUEST['telefono'];
if (!empty($buscarDireccion)) {
    $consulta = "SELECT * FROM clientes WHERE Telefono = $buscarDireccion";
    $resultado = mysqli_query($conexion, $consulta);
    $json = array();
    if (!$resultado->num_rows == 1) {
        echo 'El cliente no existe';
    } else {
        while ($row = mysqli_fetch_array($resultado)) {
            $json[] = array(
                'direccion' => $row['Direccion']
            );
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
}
