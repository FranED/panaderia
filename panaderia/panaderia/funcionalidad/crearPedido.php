<?php
include('db.php');
if (isset($_REQUEST['direccion']) && isset($_REQUEST['trabajador'])) {
    $codPedido= rand(0,20).rand(0,9999).rand(0,9999);
    $direccion = $_REQUEST['direccion'];
    $trabajador = $_REQUEST['trabajador'];
    $consulta = "INSERT INTO pedidos (idPedido, Direccion) VALUES ('$codPedido','$direccion')";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die('Error tabla Pedido ' . mysqli_error($conexion));
    } else {
        $consulta2 = "UPDATE clientes SET idPedido = '$codPedido' where Direccion = '$direccion'";
        $resultado2 = mysqli_query($conexion, $consulta2);
        if (!$resultado2) {
            die('Error tabla clientes ' . mysqli_error($conexion));
        } else {
            $consulta3 = "INSERT INTO gestiona_transporta (idPedido) VALUES ('$codPedido')";
            $resultado3 = mysqli_query($conexion, $consulta3);
            if(!$resultado3){
                die(' Error pedido en trienia' . mysqli_error($conexion));
            }else{
                // Saco por pantalla el código que me interesa para meterlo en la otra tabla ges/tran
                echo $codPedido;
            }
        }
    }
}else{
    echo 'Rellene todos los datos';
}
