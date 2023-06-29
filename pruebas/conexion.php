<?php



$host = 'localhost';
$usuario = 'cus77425_user_carlos';
$contrasena = 'Ca.208793772';
$bd = 'cus77425_bd_wenapo';

$conexion = mysqli_connect($host, $usuario, $contrasena, $bd);

if (!$conexion) {
  die("Error al conectar: " . mysqli_connect_error());
}


?>