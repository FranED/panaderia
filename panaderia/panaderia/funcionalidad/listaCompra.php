<?php
include('db.php');
$cod = $_REQUEST['codProducto'];
$consulta = "SELECT * from productos where idProducto = '$cod'";
$resultado = mysqli_query($conexion, $consulta);
if (!$resultado) {
    die("La consulta ha fallado" . mysqli_error($conexion));
} else {
    $json = array();
    while ($row = mysqli_fetch_array($resultado)) {
        $json[] = array(
            'cod' => $row['idProducto'],
            'nombre' => $row['Nombre'],
            'cantidad' => $row['Cantidad'],
            'pventa' => $row['Precio_Venta']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
};
