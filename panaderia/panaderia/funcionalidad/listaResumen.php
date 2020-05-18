<?php
include ('db.php');
$consulta = "SELECT t.Nombre,p.Nombre,p.Precio_Venta, v.cantidad from trabajador t, vende v, productos p where t.idTrabajador=v.idTrabajador and p.idProducto=v.idProducto";
$resultado = mysqli_query($conexion, $consulta);
$consulta2 = "SELECT sum(total_Compra) from vende";
$resultado2 = mysqli_query($conexion, $consulta2);
if (!$resultado) {
    die("No se puede mostrar el listado " . mysqli_error($conexion));
} else {
    $json = array();
    while ($row = mysqli_fetch_array($resultado)) {
        $json[] = array(
            'empleado' => $row['Nombre'],
            'producto' => $row['Nombre'],
            'precio' => $row['Precio_Venta'],
            'cantidad' => $row['cantidad']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
}
