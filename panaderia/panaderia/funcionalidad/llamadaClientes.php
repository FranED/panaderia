<?php
 include ('db.php');
    $cod = $_REQUEST['cod'];
    $consulta = "SELECT * FROM clientes WHERE idCliente = $cod";
    $resultado = mysqli_query($conexion,$consulta);
    if(!$resultado){
        die('Consulta fallida');
    }
    $json = array();
    while ($row = mysqli_fetch_array($resultado)){
        $json[] = array(
            'cod' => $row['idCliente'],
            'nombre' => $row['Nombre'],
            'telefono' => $row['Telefono'],
            'direccion' => $row['Direccion'],
            );
    };
    $jsonString = json_encode($json);
    echo $jsonString;