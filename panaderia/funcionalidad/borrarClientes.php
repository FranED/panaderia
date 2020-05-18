<?php
include('db.php');

if (isset($_REQUEST['cod'])) {
    $cod = $_REQUEST['cod'];
    $consulta = "DELETE from clientes where idCliente ='$cod'";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die ('La consula ha fallado');
    }else{
        echo 'Cliente eliminado';
    };
};