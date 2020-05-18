<?php

include('db.php');
if (isset($_REQUEST['cod']) && $_REQUEST['nombre'] && $_REQUEST['contrasena'] && $_REQUEST['tipo'] && $_REQUEST['alias']) {
    $tipoUsuario = strtolower($_REQUEST['tipo']);
    if ($tipoUsuario == 'jefe' || $tipoUsuario == 'trabajador') {
        $cod = $_REQUEST['cod'];
        $nombre = $_REQUEST['nombre'];
        $contrasena = $_REQUEST['contrasena'];
        $alias = $_REQUEST['alias'];
        $consulta = "UPDATE trabajador SET Nombre = '$nombre', Contraseña = '$contrasena', Tipo = '$tipoUsuario', Alias = '$alias' WHERE idTrabajador = '$cod'";
        $resultado = mysqli_query($conexion, $consulta);
        if (!$resultado) {
            die('Consulta fallida');
        }
        echo 'Trabajador actualizado';
    }else{
        echo 'tipo: trabajador o jefe';
    }
} else {
    echo 'Meter todos los datos';
}
