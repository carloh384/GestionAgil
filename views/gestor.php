<?php require'../db/sql.php'; 
session_start();?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestión de productos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Enlace a  CSS  -->
    <!-- Enlace a los estilos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Enlace al archivo JavaScript de jQuery (necesario para que funcione Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <!-- Enlace al archivo JavaScript de Popper.js (necesario para que funcionen algunos componentes de Bootstrap) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <!-- Enlace al archivo JavaScript de Bootstrap -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/estiloGestor.css"
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
            </div>
            <li>		
        				    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#agregarProductoModal">
                                Agregar producto
                            </button>
                         </li>
        </nav>
    </header>
    <div class="card-container">
        <?php
        // selecciona todos los datos de la tabla producto
        $query = "SELECT * FROM productos";
        $result_tasks = mysqli_query($conn, $query); // trae los resultados de la query
        // lista todos los productos dentro de la base de datos
        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <!-- card que contiene el producto -->
            <div class="card">
                <img src="<?php echo $row['imagen']; ?>" width="100" height="100" alt="Mi Imagen" title="Mi Imagen">
                <div class="card-body">
                    <h5 class="card-title">
                        Nombre:
                        <?php echo $row['nombre']; ?>
                    </h5>
                    <p class="card-text">
                        Descripcion:
                        <?php echo $row['descripcion']; ?>
                    </p>
                    <p class="card-text">
                        Stock:
                        <?php echo $row['stock']; ?>
                    </p>
                    <p class="card-text">
                        Valor: $
                        <?php echo number_format($row['valor']); ?>
                    </p>
                    <a href="../controller/edit.php?id=<?php echo $row['id'] ?>" class="btn btn-success">Editar</a>
                    <i class="fas fa-marker"></i>
                    </a>
                    <a href="../controller/delete_task.php?id=<?php echo $row['id'] ?>" class="btn btn-danger">Borrar</a>
                    <i class="far fa-trash-alt"></i>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
    <!-- Modal para agregar productos -->
    <div class="modal fade" id="agregarProductoModal" tabindex="-1" role="dialog"
        aria-labelledby="agregarProductoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarProductoModalLabel">Agregar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulario para agregar productos -->
                    <form action="../controller/save_task.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control" placeholder="Nombre" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" name="valor" class="form-control" placeholder="Valor" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="text" name="stock" class="form-control" placeholder="stock" autofocus>
                        </div>
                        <div class="form-group">
                            <textarea name="descripcion" rows="2" class="form-control"
                                placeholder="Descripcion"></textarea>
                        </div>
                        <div class="form-group">
                            <select name="categoria" required="">
                                <option value="">Selecciona el tipo de producto</option>
                                <option value="1">Alimentos</option>
                                <option value="2">Forraje</option>
                                <option value="3">Animales</option>
                            </select>
                        </div>

                        <label for="image">Selecciona una imagen:</label>
                        <input type="file" name="image" id="image"><br><br>
                        <input type="submit" name="submit" value="Subir imagen">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#agregarProductoModal').modal({
                show: false
            });
        });
    </script>
</body>

<footer class="footer-section">
		<div class="container">
			<div class="footer-cta pt-5 pb-5">
				<div class="row">
					<div class="col-xl-4 col-md-4 mb-30">
						<div class="single-cta">
							<i class="fa fa-map-marker"></i>
							<div class="cta-text">
								<h4>Encuentranos</h4>
								<span>Melipilla, calle fantasma, 123</span>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-4 mb-30">
						<div class="single-cta">
							<i class="fa fa-phone"></i>
							<div class="cta-text">
								<h4>LLamanos</h4>
								<span>+569 49231241</span>
							</div>
						</div>
					</div>
					<div class="col-xl-4 col-md-4 mb-30">
						<div class="single-cta">
							<i class="fa fa-envelope-open"></i>
							<div class="cta-text">
								<h4>Envianos un mensaje</h4>
								<span>contacto@griseld.cl</span>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<div class="copyright-area">
			<div class="container">
				<div class="row">
					<div class="col-xl-6 col-lg-6 text-center text-lg-left">
						<div class="copyright-text">
							<p>Copyright &copy; 2023,Todos los derechos reservados Griseld.cl</p>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
						<div class="footer-menu">
							<ul>
								<li><a href="#">Inicio</a></li>
								<li><a href="#">Terminos y condiciones</a></li>
								<li><a href="#">Privacidad</a></li>
								<li><a href="#">Politica</a></li>
								<li><a href="#">Contacto</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</footer>
</html>