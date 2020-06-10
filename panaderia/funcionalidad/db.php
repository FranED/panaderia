<?php
//Conectar con la base de datos. Defino los parámetros para el mysqli_connect
$usuario = 'sandbox';
$contrasena = 'pp58bM0o0VopH0KU';
$servidor = 'localhost';
$basededatos = 'sandbox3';
//Conectarse a la base de datos
$conexion = mysqli_connect($servidor, $usuario, $contrasena, $basededatos);
if ($conexion) { //Si existe la conexión los valores me los devolverá en la codificacion utf8
    $conexion->set_charset("utf8");
    //Comento el echo de la conexion (tras asegurarme que conecta, obvio), para que no de error el json de las consultas
    //echo 'Conexión establecida';
 }//else{//Si no se puede conectar a la base de datos que salte el error
//     $db = mysqli_select_db( $conexion, $basededatos ) or die ( "Upps! Error al conectar con la Base de datos" );
// }





