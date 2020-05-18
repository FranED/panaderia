<?php
include ('db.php');
$consulta = "SELECT * FROM productos where Visible = 'Si'";
$resultado =mysqli_query($conexion, $consulta) ;

if(!$resultado){
    die ('Error'. mysqli_error($conexion));
}else{
    $json = array();
    while ($row = mysqli_fetch_array($resultado)){
        $json[] = array(
        'cod' => $row['idProducto'],
        'nombre' => $row['Nombre']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
};