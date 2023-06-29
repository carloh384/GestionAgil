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
    <link rel="stylesheet" type="text/css" href="../css/index/productos.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Importar los archivos CSS de Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- Importar los archivos JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AlpineJS para gestionar el evento Clic -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Bentham|Playfair+Display|Raleway:400,500|Suranna|Trocchi" rel="stylesheet">
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


    <section>
        <?php
        // selecciona todos los datos de la tabla producto
        $query = "SELECT * FROM productos";
        $result_tasks = mysqli_query($conn, $query); // trae los resultados de la query
        // lista todos los productos dentro de la base de datos
        while ($row = mysqli_fetch_assoc($result_tasks)) { ?>
            <div class="card estilo-c">
                <a href="producto.php?id=<?php echo $row['id'] ?>">
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
    <!-- Start of ChatBot (www.chatbot.com) code -->
    <script type="text/javascript">
        window.__be = window.__be || {};
        window.__be.id = "645c298689d67e00072716df";
        (function() {
            var be = document.createElement('script');
            be.type = 'text/javascript';
            be.async = true;
            be.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'cdn.chatbot.com/widget/plugin.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(be, s);
        })();
    </script>
    <!-- End of ChatBot code -->
</body>

</html>