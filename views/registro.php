<?php 

	require '../db/sql.php';
    session_start();
?> 

<!DOCTYPE html>
<html lang="zxx">
<style>

</style>
<head>
	<title>LogIn</title>
    
	<!-- Meta tags -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<!-- Style -->
	<link rel="stylesheet" href="../css/style.css" type="text/css" media="all" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/index/style.css">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
	<!-- Importar los archivos CSS de Bootstrap -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
	<!-- Importar los archivos JavaScript de Bootstrap -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
	     <!-- AlpineJS para gestionar el evento Clic -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body>
<header header x-data="{ open: false }" class="header">
        <div class="logo">
            <img src="../images/logo.png" alt="Logo griseld" width="200" height="80">
        </div>
        <!-- Boton abrir -->
        <button class="header__button-nav--open" x-on:click="open = true"> &#8801; </button>
        <nav class="nav" x-bind:class="open ? 'nav--show' : ''">
            <div class="nav__button" x-on:click="open = false">
                <button class="header__button-nav--close">Cerrar</button>
            </div>
            <div class="menu">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li class="dropdown">
                        <a href="../views/productos.php">Productos</a>
                        <ul class="dropdown-menu">
                            <li><a href="../views/productos_hombre.php">Alimentos</a></li>
                            <li><a href="../views/productos_mujer.php">Forraje</a></li>
                            <li><a href="../views/productos_ninos.php">Animales</a></li>
                        </ul>
                    </li>
                    <li><a href="../views/nosotros.php">Nosotros</a></li>
                </ul>
            </div>

            <div class="search-bar">

                <form method="GET" action="../pruebas/buscador.php">
                    <input type="text" name="busqueda" placeholder="Buscar productos">
                    <button type="submit">Buscar</button>
                </form>

            </div>
            <div class="user-profile">
                <?php
                // Verificar si el usuario está autenticado
                if (isset($_SESSION['nombre_usuario'])) {
                    // Mostrar el nombre del usuario si está autenticado
                    echo '<span>Bienvenido, ' . $_SESSION['nombre_usuario'] . '</span>';
                    echo '<a href="../controller/cerrar.php" class="btn btn-danger">Cerrar sesión</a>';
                } else {
                    // Mostrar botón de inicio de sesión si el usuario no está autenticado
                    echo '<a href="../views/login.php" class="btn btn-primary">Iniciar sesión</a>';
                }
                ?>

                <?php
                $totalProductos = 0;
                foreach ($_SESSION['carrito'] as $item) {
                    $totalProductos += $item['cantidad'];
                }
                ?>
                <div class="carrito">
                    <!-- Contenido del carrito -->
                </div>
            </div>


            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Carrito (
                <?php echo $totalProductos; ?>)
            </button>
        </nav>
    </header>


    
    
	<!-- login form -->
	<section class="w3l-login">
		<div class="overlay">
			<div class="wrapper">
				<div class="form-section">
					<h3>Registrate!</h3>
					<!-- formulario login -->
                    <form action="../controller/funciones.php" method="post" class="signin-form">
                        <div class="form-input">
                            <input type="hidden" name="funcion" value="registro">
                            <input type="text" placeholder="Nombre usuario" required="" name="nombre">
                        </div>
                        
                        <div class="form-input">
                            <input type="email" placeholder="Correo" required="" name="correo">
                        </div>
                        
                        <div class="form-input">
                            <input type="password" placeholder="Contraseña" required="" name="contrasena">
                        </div>
                        
                        <div class="form-input">
                            <select name="rol" required="">
                                <option value="">Selecciona el tipo de usuario</option>
                                <option value="0">Usuario normal</option>
                                <option value="1">Tienda</option>
                            </select>
                        </div>
                        
                        <label class="check-remaind">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                            <p class="remember">Acepto los términos y condiciones</p>
                        </label>
                        
                        <button type="submit" class="mi-boton">Registrarse</button>
                        
                        <br><br>
                        
                        <button type="button" class="mi-boton3" onclick="window.location.href='https://usuario11.talleresmelipilla.cl/griseld/views/login.php'">¿Ya tienes cuenta? Inicia sesión</button>
                        
                        <br>
                        
                        <div class="new-signup">
                            <!-- boton modal recuperar -->
                            <br>
                            <button type="button" class="mi-boton2" id="myBtn">¿Olvidaste tu contraseña?</button>
                            <br>
                        </div>
                    </form>
                    <br>

					<br>
				</div>
			</div>
		</div>
	</section>

	<!-- /login form -->
	  <!-- Modal recuperar -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4><span class="glyphicon glyphicon-lock"></span> Recuperar</h4>
        </div>
        <div class="modal-body" style="padding:40px 50px;">
          <form action="../controller/funciones.php" method="post">
                            <input type="text" class="text" name="correo_usuario" placeholder="Correo usuario" required="" autofocus>
                            <input type = "hidden" name="funcion" value="recuperar"/>
                            <br>
                            <button class="btn" type="submit">Recuperar</button>
                        </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
        </div>
      </div>
      
    </div>
  </div> 

 
<script>
$(document).ready(function(){
  $("#myBtn").click(function(){
    $("#myModal").modal();
  });
});
</script>


 
<script>
$(document).ready(function(){
  $("#myBtn2").click(function(){
    $("#myModal2").modal();
  });
});
</script>
</body>

</html>