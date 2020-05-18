<?php
include('db.php');

if (isset($_REQUEST['cod'])) {
    $cod = $_REQUEST['cod'];
    $consulta = "DELETE from productos where idProducto ='$cod'";
    $resultado = mysqli_query($conexion, $consulta);

    if (!$resultado) {
        die ('La consula ha fallado');
    }else{
        echo 'Producto eliminado';
    };
};
