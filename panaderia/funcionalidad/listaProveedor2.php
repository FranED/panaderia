<?php
include ('db.php');
$consulta = "SELECT * from proveedores";
$resultado = mysqli_query($conexion,$consulta);
if(!$resultado){
    die ("Consulta fallida");
}else{
    $json = array();
    while($row = mysqli_fetch_array($resultado)){
        $json[] = array(
            'cod' => $row['idProveedor'],
            'compania' => $row['Nombre']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
};