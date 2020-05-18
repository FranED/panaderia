<?php
include ('db.php');
$consulta = "SELECT * from productos";
$resultado = mysqli_query($conexion, $consulta);
if(!$resultado){
    die ("La consulta ha fallado" . mysqli_error($conexion)); 
}else{
    $json = array();
    while ($row = mysqli_fetch_array($resultado)){
        $json[] = array(
        'cod' => $row['idProducto'],
        'nombre' => $row['Nombre'],
        'cantidad' => $row['Cantidad'],
        'precio' => $row['Precio'],
        'pventa' => $row['Precio_Venta'],
        'visibilidad' => $row['Visible']
        );
    };
    $jsonstring = json_encode($json);
    echo $jsonstring;
};

