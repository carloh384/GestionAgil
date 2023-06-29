<?php
#incluye el archivo bd.php que contiene la conexion a la base de datos
#include('db.php');
#comprueba si el formulario contiene datos
// Conexión a la base de datos

require'../db/sql.php';
$nombre = $_POST['nombre'];
$valor = $_POST['valor'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];
$categoria = $_POST['categoria'];
// Carpeta de destino para guardar la imagen subida
$target_dir = "../images/";
// Nombre de la imagen subida
$target_file = $target_dir . basename($_FILES["image"]["name"]);
// Verificar si el archivo es una imagen
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif" ) {
	echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
	exit;
}
// Verificar si el archivo ya existe en la carpeta de destino
if (file_exists($target_file)) {
	echo "Lo siento, ya existe una imagen con ese nombre.";
	exit;
}
// Verificar si se pudo subir la imagen
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
	echo "La imagen ". basename( $_FILES["image"]["name"]). " se ha subido correctamente.";
	// Guardar la ruta de la imagen en la base de datos
	$sql = "INSERT INTO `productos` (`nombre`, `valor`, `stock`,`descripcion`,`imagen`,`categoria` ) VALUES ('$nombre', '$valor', '$stock', '$descripcion','$target_file','$categoria')";
    
	if ($conn->query($sql) === TRUE) {
		echo "La ruta de la imagen se ha guardado en la base de datos.";
	} else {
		echo "Error al guardar la ruta de la imagen: " . $conn;
	}
} else {
	echo "Error al subir la imagen.";
}
$conn->close();
    $_SESSION['message'] = 'Producto guardado exitosamente';
    $_SESSION['message_type'] = 'success';
	header("Location: ../views/gestor.php");










?>