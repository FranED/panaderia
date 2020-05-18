<?php
include('db.php');
if(isset($_REQUEST['cod'])) {
  $cod = $_REQUEST['cod'];
  $consulta = "DELETE FROM trabajador WHERE idTrabajador = '$cod'"; 
  $resultado = mysqli_query($conexion, $consulta);

  if (!$resultado) {
    die('La consulta falla');
  }
  echo "Trabajador Eliminado";  
}