<?php
 include ('db.php');
    $cod = $_REQUEST['cod'];
    $consulta = "SELECT * FROM empresa_transporte WHERE idEmpTransporte = $cod";
    $resultado = mysqli_query($conexion,$consulta);
    if(!$resultado){
        die('Consulta fallida');
    }
    $json = array();
    while ($row = mysqli_fetch_array($resultado)){
        $json[] = array(
            'cod' => $row['idEmpTransporte'],
            'nombre' => $row['Nombre'],
            'telefono' => $row['Teléfono'],
            'comision' => $row['Comision'],
            );
    };
    $jsonString = json_encode($json);
    echo $jsonString;