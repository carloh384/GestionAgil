<?php
require '../db/sql.php';



if (isset($_GET['id'])) {

    $id = $_GET['id'];



    // Obtener la ruta de la imagen asociada al producto

    $query = "SELECT imagen FROM productos WHERE id = $id";

    $result = mysqli_query($conn, $query);

    if (!$result) {

        die("Query Failed.");

    }

    $row = mysqli_fetch_assoc($result);

    $imagen = $row['imagen'];



    // Eliminar el registro del producto de la base de datos

    $query = "DELETE FROM productos WHERE id = $id";

    $result = mysqli_query($conn, $query);

    if (!$result) {

        die("Query Failed.");

    }



    // Eliminar la imagen del servidor

    if (file_exists('' . $imagen)) {

        if (unlink('' . $imagen)) {

            echo "La imagen y el producto se han eliminado correctamente.";

        } else {

            echo "No se pudo eliminar la imagen del servidor.";

        }

    } else {

        echo "La imagen no existe en el servidor.";

    }



    $_SESSION['message'] = 'Producto eliminado!';

    $_SESSION['message_type'] = 'danger';

    header("Location: ../views/gestor.php");
}

?>

