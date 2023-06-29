<?php
// Conexión a la base de datos

$conn = new mysqli("localhost", "cus77425_user_carlos", "Ca.208793772", "cus77425_bd_wenapo");
if ($conn->connect_error) {
	die("Conexión fallida: " . $conn->connect_error);
}
$nombre = $_POST['nombre'];
$valor = $_POST['valor'];
$stock = $_POST['stock'];
$descripcion = $_POST['descripcion'];
// Carpeta de destino para guardar la imagen subida
$target_dir = "uploads/";
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
	$sql = "INSERT INTO `productos` (`nombre`, `valor`, `stock`,`descripcion`,`imagen` ) VALUES ('$nombre', '$valor', '$stock', '$descripcion','$target_file')";
    
	if ($conn->query($sql) === TRUE) {
		echo "La ruta de la imagen se ha guardado en la base de datos.";
	} else {
		echo "Error al guardar la ruta de la imagen: " . $conn->error;
	}
} else {
	echo "Error al subir la imagen.";
}
$conn->close();
?>
