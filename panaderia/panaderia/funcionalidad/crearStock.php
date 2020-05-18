<?php

include('db.php');

if (!empty($_REQUEST['cBarras']) && isset($_REQUEST['nomProducto']) && isset($_REQUEST['nProductos']) && isset($_REQUEST['precio']) && isset($_REQUEST['precioVenta']) && isset($_REQUEST['visibilidad'])) {
    $tipoProducto = strtolower($_REQUEST['visibilidad']);
    if ($tipoProducto == "si" || $tipoProducto == "no") {
        $codP = $_REQUEST['codProveedor'];
        $cod = $_REQUEST['cBarras'];
        $nombre = $_REQUEST['nomProducto'];
        $numero = $_REQUEST['nProductos'];
        $precio = $_REQUEST['precio'];
        $precioV = $_REQUEST['precioVenta'];
        $consulta = "INSERT INTO productos (idProducto,idProveedor, Nombre, Cantidad, Precio, Precio_Venta, Visible) VALUES ('$cod','$codP', '$nombre','$numero','$precio','$precioV','$tipoProducto')";
        $resultado = mysqli_query($conexion, $consulta);
        if (!$resultado) {
            die('Error tabla Producto ' . mysqli_error($conexion));
        } else {
            echo 'Producto agregado';
        }
    } else {
        echo 'Visible: Sí o No ';
    }
} else {
    echo 'Rellenar los campos';
}
