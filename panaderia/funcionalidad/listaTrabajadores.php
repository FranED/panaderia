<?php
include ('db.php');
$consulta = "SELECT * FROM trabajador";
$resultado = mysqli_query($conexion,$consulta);

if(!$resultado){
    die("Consulta Fallida" . mysqli_error($conexion));
}else{
    $json = array();
    while ($row = mysqli_fetch_array($resultado)){
        $json[]=array(
            'cod' => $row['idTrabajador'],
            'nombre' => $row['Nombre'],
            'contrasena' => $row['Contraseña'],
            'tipo' => $row['Tipo'],
            'alias' => $row['Alias']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
};
