<?php
require '../db/sql.php';

$nombre = '';
$valor = '';
$stock = '';
$descripcion = '';
$imagen = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM productos WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_array($result);
        $nombre = $row['nombre'];
        $valor = $row['valor'];
        $stock = $row['stock'];
        $descripcion = $row['descripcion'];
        $imagen = $row['imagen'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $valor = $_POST['valor'];
    $stock = $_POST['stock'];
    $descripcion = $_POST['descripcion'];

    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["imagen"]["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si se subió una nueva imagen
    if (!empty($_FILES["imagen"]["tmp_name"])) {
        // Verificar si el archivo es una imagen
        if ($imageFileType != "jpg" && $imageFileType != "jpeg" && $imageFileType != "png" && $imageFileType != "gif") {
            echo "Solo se permiten archivos JPG, JPEG, PNG y GIF.";
            exit;
        }

        // Verificar si ya existe una imagen con ese nombre
        if (file_exists($target_file)) {
            echo "Lo siento, ya existe una imagen con ese nombre.";
            header('Location: ../views/gestor.php');
            exit;
        }

        // Mover la imagen subida a la carpeta de destino
        if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
            // Eliminar la imagen anterior si existe
            if (!empty($imagen) && file_exists($imagen)) {
                unlink($imagen);
            }
            $imagen = $target_file;
        } else {
            echo "Error al subir la imagen.";
            exit;
        }
    }

    $query = "UPDATE productos SET nombre = '$nombre', valor = '$valor', stock = '$stock', descripcion = '$descripcion', imagen = '$imagen' WHERE id=$id";
    mysqli_query($conn, $query);

    $_SESSION['message'] = 'Producto actualizado!';
    $_SESSION['message_type'] = 'warning';
    header('Location: ../views/gestor.php');
}
?>

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

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function () {
            var output = document.getElementById('preview');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<div class="container p-4">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input name="nombre" type="text" class="form-control" value="<?php echo $nombre; ?>"
                            placeholder="Actualizar nombre">
                    </div>
                    <div class="form-group">
                        <textarea name="valor" class="form-control"
                            placeholder="Actualizar valor"><?php echo $valor; ?></textarea>
                    </div>
                    <div class="form-group">
                        <input name="stock" type="text" class="form-control" value="<?php echo $stock; ?>"
                            placeholder="Actualizar stock">
                    </div>
                    <div class="form-group">
                        <input name="descripcion" type="text" class="form-control"
                            value="<?php echo $descripcion; ?>" placeholder="Actualizar descripcion">
                    </div>
                    <div class="form-group">
                        <label for="imagen">Imagen actual:</label><br>
                        <?php if ($imagen): ?>
                        <img src="<?php echo $imagen; ?>" alt="Imagen actual" style="max-width: 200px;"><br>
                        <?php else: ?>
                        <span>No se ha seleccionado ninguna imagen.</span><br>
                        <?php endif; ?>
                        <input name="imagen" type="file" class="form-control" placeholder="Actualizar Imagen"
                            onchange="previewImage(event)">
                    </div>
                    <div class="form-group">
                        <label for="preview">Vista previa:</label><br>
                        <img id="preview" src="" alt="Vista previa" style="max-width: 200px;">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <button class="btn btn-success" name="update">Actualizar</button>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-secondary" href="edit.php?id=<?php echo $_GET['id']; ?>">Mantener imagen </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
