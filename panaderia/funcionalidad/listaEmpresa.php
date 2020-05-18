<?php
include ('db.php');
$consulta = "SELECT * from empresa_transporte";
$resultado = mysqli_query($conexion,$consulta);
if(!$resultado){
    die ("Consulta fallida");
}else{
    $json = array();
    while($row = mysqli_fetch_array($resultado)){
        $json[] = array(
            'cod' => $row['idEmpTransporte'],
            'nombre' => $row['Nombre'],
            'telefono' => $row['Teléfono'],
            'comision' => $row['Comision']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
};