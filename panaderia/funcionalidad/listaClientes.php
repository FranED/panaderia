<?php
include ('db.php');
$consulta = "SELECT * from clientes";
$resultado = mysqli_query($conexion,$consulta);
if(!$resultado){
    die ("Consulta fallida");
}else{
    $json = array();
    while($row = mysqli_fetch_array($resultado)){
        $json[] = array(
            'cod' => $row['idCliente'],
            'nombre' => $row['Nombre'],
            'telefono' => $row['Telefono'],
            'direccion' => $row['Direccion']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
};