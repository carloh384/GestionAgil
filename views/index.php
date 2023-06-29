<?php
require '../db/sql.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
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
                    echo '<a href="../controller/cerrar.php" class="btn btn-danger">Cerrar sesion</a>';
                    
                    // Verificar si el usuario tiene rol igual a 1
                    if ($_SESSION['rol'] == 1) {
                        // Mostrar el botón que dirige a gestor.php
                        echo '<a href="../views/gestor.php" class="btn btn-primary">Gestor</a>';
                    }
                } else {
                    // Mostrar botón de inicio de sesión si el usuario no está autenticado
                    echo '<a href="../views/login.php" class="btn btn-primary">Iniciar sesion</a>';
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


    <div class="carrusel-container">
        <div id="carouselExampleFade" class="carousel slide carousel-fade">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="../images/banner1.jpg" class="d-block w-100" height="600" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/banner2.jpg" class="d-block w-100" height="600" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../images/banner3.jpg" class="d-block w-100" height="600" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>






    <!-- aqui van los productos destacados -->

    <section>
        <?php
        // selecciona todos los datos de la tabla producto
        $query = "SELECT * FROM productos
 ";
        $result_tasks = mysqli_query($conn, $query); // trae los resultados de la query
        // lista todos los productos dentro de la base de datos
        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <!-- card que contiene el producto -->
            <div class="card estilo-c">
                <a href="#">
                    <div class="img-container">
                        <img src="<?php echo $row['imagen']; ?>" alt="Mi Imagen" title="Mi Imagen">
                    </div>
                </a>
                <div class="info-container">
                    <h3><?php echo $row['nombre']; ?></h3>
                    <strong>$<?php echo number_format($row['valor']); ?></strong>
                    <form method="post" action="../views/carrito.php">
                        <input type="hidden" name="imagen" value="<?php echo $row['imagen']; ?>">
                        <input type="hidden" name="producto" value="<?php echo $row['nombre']; ?>">
                        <input type="hidden" name="precio" value="<?php echo $row['valor']; ?>">
                        <button type="submit">A&ntilde;adir al carrito</button>
                    </form>
                </div>
            </div>
        <?php } ?>
    </section>



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
                                <h4>Llamanos</h4>
                                <span>+569 49231241</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fa fa-envelope-open"></i>
                            <div class="cta-text">
                                <h4>Envianos un mensaje</h4>
                                <span>contacto@portaldelcampo.cl</span>
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
                            <p>Copyright &copy; 2023,Todos los derechos reservados portaldelcampo.cl</p>
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

    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Carrito de compra</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="carrito">
                        <ul class="list-group">
                            <?php
                            $total = 0;
                            foreach ($_SESSION['carrito'] as $key => $item) {
                                echo "<li class='list-group-item'>";
                                echo "<div class='d-flex justify-content-between'>";
                                echo "<span>" . $item['producto'] . "</span>";
                                echo "<form method='post' action='../views/carrito.php'>";
                                echo "<input type='hidden' name='accion' value='actualizar'>";
                                echo "<input type='hidden' name='producto' value='" . $item['producto'] . "'>";
                                echo "<div class='input-group'>";
                                echo "<button class='btn btn-outline-secondary' type='button' onclick='actualizarCantidad(\"" . $item['producto'] . "\", -1)'>-</button>";
                                echo "<input type='number' class='form-control' name='cantidad' value='" . $item['cantidad'] . "' min='1' max='100'>";
                                echo "<button class='btn btn-outline-secondary' type='button' onclick='actualizarCantidad(\"" . $item['producto'] . "\", 1)'>+</button>";
                                echo "</div>";
                                echo "</form>";
                                echo "<span>$" . $item['precio'] * $item['cantidad'] . "</span>";
                                echo "</div>";
                                echo "<form method='post' action='../views/carrito.php'>";
                                echo "<input type='hidden' name='accion' value='borrar'>";
                                echo "<input type='hidden' name='producto' value='" . $item['producto'] . "'>";
                                echo "<button type='submit' class='btn btn-danger'>Eliminar</button>";
                                echo "</form>";
                                echo "</li>";
                                $total += ($item['precio'] * $item['cantidad']);
                            }

                            $totalProductos = 0;
                            foreach ($_SESSION['carrito'] as $item) {
                                $totalProductos += $item['cantidad'];
                            }
                            echo "Total de productos en el carrito: " . $totalProductos;


                            ?>

                        </ul>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>

                    <a href="../views/carrito.php"><button type="button" class="btn btn-primary">Ir a pagar</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>