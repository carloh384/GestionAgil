<?php 
    session_start();
    require '../db/sql.php';
?> 

<!DOCTYPE html>
<html lang="zxx">
<style>

</style>

<head>
    <title>Nosotros</title>

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

    <div class="banner">
        <div class="content-nosotros">
        <div class="nosotros">
            <br>
            <br>
            <br>
            <h1>SOBRE NOSOTROS</h1>
<br>
<br>
<br>
            <p>Bienvenido/a a nuestra tienda en línea de ropa.</p>

            <h2>Nuestra misión</h2>

            <p>Nuestra misión es proporcionarte ropa de calidad que no solo te haga lucir bien, sino que también te haga
                sentir confiado/a y cómodo/a.</p>

            <h2>Nuestra selección</h2>

            <p>En nuestra tienda, encontrarás una amplia gama de prendas para cada ocasión. Desde ropa casual y
                deportiva hasta elegantes conjuntos formales, tenemos opciones para todos los gustos y necesidades.
                .</p>

            <h2>Atención al cliente</h2>

            <p>Nuestro equipo de atención al cliente está aquí para ayudarte en cada paso del camino.
            </p>

            <h2>Envío y devoluciones</h2>

            <p>Ofrecemos envío rápido y seguro.</p>

        </div>
    </div>
    </div>
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