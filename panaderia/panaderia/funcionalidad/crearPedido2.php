<?php
include('db.php');
$codPedido = $_REQUEST['cod'];
$trabajador =$_REQUEST['trabajador'];
$emp =$_REQUEST['empresa'];
$consulta = "UPDATE gestiona_transporta set idTrabajador = '$trabajador', idEmpTransporte = '$emp' where idPedido = '$codPedido'";
$resultado = mysqli_query($conexion, $consulta);
if (!$resultado) {
    die('Error tabla Pedido ' . mysqli_error($conexion));
}else{
    echo 'Pedido realizado';
}
