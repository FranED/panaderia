<?php 

include ('db.php');

if (isset($_REQUEST['cod'])){
    $cod = $_REQUEST['cod'];
    $consulta = "DELETE FROM proveedores where idProveedor = '$cod'";
    $resultado = mysqli_query($conexion,$consulta);
    if(!$resultado){
        die ('Consulta fallida');
    }else{
        echo 'Proveedor borrado';
    }
}