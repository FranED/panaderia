<?php
 include ('db.php');

    $cod = $_REQUEST['cod'];
    $consulta = "SELECT * FROM productos WHERE idProducto = $cod";
    $resultado = mysqli_query($conexion,$consulta);
    if(!$resultado){
        die('Consulta fallida');
    }
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
    $jsonString = json_encode($json);
    echo $jsonString;