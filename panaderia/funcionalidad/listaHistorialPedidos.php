<?php
include('db.php');
    $consulta = "select t.Nombre as trabajador,e.Teléfono, e.Nombre,p.Direccion, e.Comision from trabajador t, empresa_transporte e, pedidos p, gestiona_transporta g WHERE t.idTrabajador=g.idTrabajador and e.idEmpTransporte=g.idEmpTransporte and p.idPedido=g.idPedido";
    $resultado = mysqli_query($conexion, $consulta);
    if (!$resultado) {
        die ("La consulta ha fallado" . mysqli_error($conexion)); 
    } else{
        $json = array();
        while ($row = mysqli_fetch_array($resultado)){
            $json[] = array(
            'trabajador' => $row['trabajador'],
            'direccion' => $row['Direccion'],
            'telefono' => $row['Teléfono'],
            'empresa' => $row['Nombre'],
            'comision' => $row['Comision']
            );
        };
        $jsonstring = json_encode($json);
        echo $jsonstring;
    };
