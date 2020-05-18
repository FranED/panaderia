<?php
include ('db.php');
// Cada vez que se salga del programa reiniciará las ventas de productos del turno
$consulta = "TRUNCATE TABLE vende";
$resultado = mysqli_query($conexion,$consulta);
// Cerramos la conexión a la base de datos
$conexion->close();
// Botón de salir redirecciona a esta página donde ...
// Con la inición que está iniciada
session_start();
// La acabamos
// elimina las variables de sesión
session_unset();
// destruye la sesión
session_destroy();
// Y la redireccionamos al login
header ('location: ../Web/login.php');

?>