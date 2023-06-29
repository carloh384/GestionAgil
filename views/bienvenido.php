<?php 
    session_start();
    require '../db/sql.php';
if (empty($_SESSION["correo_usuario"])){
    
    echo "<script> alert('Debe iniciar sesion');window.location= 'https://usuario11.talleresmelipilla.cl/griseld/' </script>";
    exit();
}
?> 

<!DOCTYPE html>
<html lang="zxx">

<head>
	<title>LogIn</title>

	<!-- Meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Style -->
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
	<!-- login form -->
	<section class="w3l-login">
		<div class="overlay">
			<div class="wrapper">
				<div class="form-section">
					<h3>Iniciar sesion</h3>
					
					<!-- listar usuario-->
					<?php
					    echo "Hola " . $_SESSION["correo_usuario"] . "<br>";
					    echo "Tu contraseña es:  " . $_SESSION["nombre_usuario"] . "<br>";
					    
					    echo '<a href="correo/cerrar.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Cerrar sesion</a>';
					?>
					<br>
				</div>
			</div>
		</div>
		<div id='stars'></div>
		<div id='stars2'></div>
		<div id='stars3'></div>

		<!-- copyright -->
		<div class="copy-right">
			<p>&copy; 2020 login con php. Todos los derechos reservados | Design by <a href="http://w3layouts.com/" target="_blank">W3Layouts</a></p>
		</div>
		<!-- //copyright -->
	</section>

	<!-- /login form -->


</html>