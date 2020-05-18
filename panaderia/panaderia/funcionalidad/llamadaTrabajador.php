<?php
 include ('db.php');

    $cod = $_REQUEST['cod'];
    $consulta = "SELECT * FROM trabajador WHERE idTrabajador = $cod";
    $resultado = mysqli_query($conexion,$consulta);
    if(!$resultado){
        die('Consulta fallida');
    }
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
    $jsonString = json_encode($json);
    echo $jsonString;
