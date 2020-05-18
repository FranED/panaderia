<?php
include('db.php');
$codTicket =  rand(0,20).rand(0,9999).rand(0,9999);
$cod = $_REQUEST['codProducto'];
$cantidad = $_REQUEST['cantidad'];
$codTrabajador = $_REQUEST['codTrabajador'];
$venta = $_REQUEST['totVenta'];
$consulta = "UPDATE productos SET Cantidad = (Cantidad - '$cantidad') WHERE idProducto = '$cod'";
$resultado = mysqli_query($conexion, $consulta);
$consulta2 = "INSERT INTO vende (codTicket, idTrabajador, idProducto, total_Compra, cantidad) VALUES ('$codTicket','$codTrabajador','$cod','$venta','$cantidad')";
$resultado2 = mysqli_query($conexion, $consulta2);

if (!$resultado) {
    die('Consulta actualizar falla');
} else {
    if (!$resultado2) {
        die('tabla vende falla' . mysqli_error($conexion));
    } else {
        echo 'Actualizado';
    }
}
