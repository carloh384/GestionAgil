
<?php
// Conexión a la base de datos 
include("conexion.php");
// Obtener el término de búsqueda
$termino = $_GET['busqueda'];

// Consulta SQL para buscar productos que coincidan con el término de búsqueda
$consulta = "SELECT * FROM productos WHERE nombre LIKE '%$termino%' OR descripcion LIKE '%$termino%'";
$resultado = mysqli_query($conexion, $consulta);
?>

<html lang="zxx">

<head>
    <title>Nosotros</title>

    <!-- Meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Style -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/index/nosotros.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
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
            <img src="../gestor/images/logo.png" alt="Mi logo" width="80" height="80">
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
                        <a href="#">Productos</a>
                        <ul class="dropdown-menu">
                            <li><a href="productos_hombre.php">Ropa para hombres</a></li>
                            <li><a href="productos_mujer.php">Ropa para mujeres</a></li>
                            <li><a href="productos_ninos.php">Ropa para ni&ntilde;os</a></li>
                        </ul>
                    </li>
                    <li><a href="nosotros.php">Nosotros</a></li>
                </ul>
            </div>

            <div class="search-bar">
                <form>
                    <input type="text" placeholder="Buscar productos...">
                    <button type="submit">Buscar</button>
                </form>
            </div>
            <div class="user-profile">
                <a href="login.php">Iniciar sesion</a>
                <a href="#">Carrito (0)</a>
            </div>
        </nav>
    </header>
    

<?php
// Mostrar los resultados
if (mysqli_num_rows($resultado) > 0) {
  while ($fila = mysqli_fetch_assoc($resultado)) {
    echo "ID: " . $fila['id'] . "<br>";
    echo "Nombre: " . $fila['nombre'] . "<br>";
    echo '<img src="../gestor/' . $fila['imagen'] . '" width="100" height="100" alt="Mi Imagen">';
    echo "Descripción: " . $fila['descripcion'] . "<br><br>";
  }
} else {
  echo "No se encontraron resultados.";
}
?>




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
</body>

</html>
<?php
// Cerrar la conexión a la base de datos
mysqli_close($conexion);
?>
