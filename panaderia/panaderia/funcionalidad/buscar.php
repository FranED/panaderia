<?php
include('db.php');

$buscar = $_REQUEST['buscar'];

if (!empty($buscar)) {
    $consulta = "SELECT * FROM productos WHERE Nombre LIKE '$buscar%'";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die('Error en la consulta ' . mysqli_error($conexion));
    }
    $json = array();
    while ($row = mysqli_fetch_array($resultado)) {
        $json[] = array(
            'nombre' => $row['Nombre'],
            'precio' => $row['Precio_Venta']
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
