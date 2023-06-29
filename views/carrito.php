<?php
require '../db/sql.php';
session_start();
if (!isset($_SESSION['carrito'])) {
	$_SESSION['carrito'] = [];
}
if (isset($_POST['producto']) && isset($_POST['precio'])) {
	$imagen = $_POST['imagen'];
	$producto = $_POST['producto'];
	$precio = $_POST['precio'];
	$encontrado = false;
	// Buscar si el producto ya está en el carrito
	foreach ($_SESSION['carrito'] as &$item) {
		if ($item['producto'] == $producto) {
			$item['cantidad'] += 1;
			$encontrado = true;
			break;
		}
	}
	// Si el producto no está en el carrito, agregarlo
	if (!$encontrado) {
		array_push($_SESSION['carrito'], ['producto' => $producto, 'precio' => $precio, 'cantidad' => 1]);
	}
} elseif (isset($_POST['accion']) && $_POST['accion'] == 'borrar' && isset($_POST['producto'])) {
	$producto = $_POST['producto'];
	// Buscar el producto en el carrito
	foreach ($_SESSION['carrito'] as $clave => $item) {
		if ($item['producto'] == $producto) {
			// Eliminar el producto del carrito
			unset($_SESSION['carrito'][$clave]);
			break;
		}
	}
	// Reindexar el arreglo del carrito
	$_SESSION['carrito'] = array_values($_SESSION['carrito']);
	header('Location: ../views/carrito.php');
	exit();
}
$total = 0;

// Verificar si se ha enviado un formulario
if (isset($_POST['accion'])) {

	// Actualizar la cantidad de un producto en el carrito
	if ($_POST['accion'] == 'actualizar') {
		$producto = $_POST['producto'];
		$cantidad = $_POST['cantidad'];

		// Verificar que la cantidad sea un número válido
		if (is_numeric($cantidad) && $cantidad > 0) {

			// Actualizar la cantidad del producto en el carrito
			foreach ($_SESSION['carrito'] as &$item) {
				if ($item['producto'] == $producto) {
					$item['cantidad'] = $cantidad;
					break;
				}
			}
		}
	}

	// Eliminar un producto del carrito
	if ($_POST['accion'] == 'borrar') {
		$producto = $_POST['producto'];

		// Buscar el producto en el carrito y eliminarlo
		foreach ($_SESSION['carrito'] as $key => $item) {
			if ($item['producto'] == $producto) {
				unset($_SESSION['carrito'][$key]);
				break;
			}
		}
	}

	// Redirigir a la página del carrito
	header('Location: ../views/carrito.php');
	exit();



}
?>
<!-- 
<script>
	function actualizarCantidad(producto, cantidad) {
		var form = document.querySelector("form[action='carrito.php'] input[value='" + producto + "']").parentNode;
		var cantidadInput = form.querySelector("input[name='cantidad']");
		cantidadInput.value = parseInt(cantidadInput.value) + cantidad;
		var data = new FormData(form);

		fetch('carrito.php', {
			method: 'POST',
			body: data
		}).then(function (response) {
			if (response.ok) {
				response.text().then(function (html) {
					var carrito = document.querySelector('.carrito');
					carrito.innerHTML = html;
					var resumen = document.querySelector('.resumen table tbody');
					resumen.innerHTML = new DOMParser().parseFromString(html, 'text/html').querySelector('.resumen table tbody').innerHTML;
				});
			}
		}).catch(function (error) {
			console.error(error);
		});
	}


</script>-->

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

	<div class="container mt-5">
		<div class="row">
			<div class="col-md-8">
				<h2>Carrito de compras</h2>
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
			<div class="col-md-4">
				<h2>Resumen del pedido</h2>
				<div class="resumen">
					<table class="table">
						<tbody>
							<tr>
								<td>Subtotal</td>
								<td>$
									<?php echo number_format($total, 2); ?>
								</td>
							</tr>
							<tr>
								<td>Envio</td>
								<td>$0.00</td>
							</tr>
							<tr>
								<td>Total</td>
								<td>$
									<?php echo number_format($total, 2); ?>
								</td>
							</tr>
						</tbody>
					</table>
					<a href="#" class="btn btn-primary">Pagar</a>
				</div>
			</div>
		</div>
	</div>
</body>

</html>