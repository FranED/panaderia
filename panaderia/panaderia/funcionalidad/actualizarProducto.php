<?php

include('db.php');
if (isset($_REQUEST['cod']) && isset($_REQUEST['nombre']) && isset($_REQUEST['cantidad']) && isset($_REQUEST['precio']) && isset($_REQUEST['pventa']) && isset($_REQUEST['visibilidad'])) {
    $tipoProducto = strtolower($_REQUEST['visibilidad']);
    if ($tipoProducto == "si" || $tipoProducto == "no") {
        $cod = $_REQUEST['cod'];
        $nombre = $_REQUEST['nombre'];
        $cantidad = $_REQUEST['cantidad'];
        $precio = $_REQUEST['precio'];
        $pventa = $_REQUEST['pventa'];
        $consulta = "UPDATE productos SET Nombre = '$nombre', Cantidad = '$cantidad', Precio = '$precio', Precio_Venta = '$pventa',Visible = '$tipoProducto' WHERE idProducto = '$cod'";
        $resultado = mysqli_query($conexion, $consulta);
        if (!$resultado) {
            die('Consulta fallida');
        }
        echo 'Producto actualizado';
    } else {
        echo 'Visible: Sí o No ';
    }
} else {
    echo 'Meter todos los datos';
}
