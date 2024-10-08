<?php
session_start();

@$link = new mysqli('localhost', 'root', '123456789a', 'marketzone');

if ($link->connect_errno) {
    die('Falló la conexión: ' . $link->connect_error);
}

// Captura de los datos enviados desde el formulario
$nombre = $_POST['nombre'] ?? null;
$marca = $_POST['marca'] ?? null;
$modelo = $_POST['modelo'] ?? null;
$precio = $_POST['precio'] ?? null;
$detalles = $_POST['detalles'] ?? null;
$unidades = $_POST['unidades'] ?? null;
$imagen = null; // Inicialización de la variable de la imagen

// Validación de campos requeridos
if (empty($nombre) || empty($marca) || empty($modelo) || !isset($precio) || 
    empty($detalles) || !isset($unidades)) {
    die('Todos los campos son requeridos y el precio debe ser un número válido.');
}

// Validar que el precio es un número y mayor o igual a 0
if (!is_numeric($precio) || $precio < 0) {
    die('El precio debe ser un número mayor o igual a 0.');
}

// Validar que las unidades son un número entero positivo
if (!is_numeric($unidades) || $unidades < 0) {
    die("Las unidades deben ser un número entero positivo.");
}

// Validar detalles (no vacíos y longitud máxima)
if (strlen($detalles) > 250) {
    die("Los detalles no deben exceder 250 caracteres.");
}

// Manejo de la imagen
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['imagen']['tmp_name'];
    $fileName = $_FILES['imagen']['name'];
    $fileSize = $_FILES['imagen']['size'];
    $fileType = $_FILES['imagen']['type'];

    // Obtener la extensión del archivo
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));

    // Extensiones permitidas
    $allowedfileExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    // Validar la extensión de archivo
    if (!in_array($fileExtension, $allowedfileExtensions)) {
        die("Solo se permiten archivos JPG, JPEG, PNG y GIF.");
    }

    // Validar tamaño del archivo (por ejemplo, max 2MB)
    $maxFileSize = 2 * 1024 * 1024; // 2MB
    if ($fileSize > $maxFileSize) {
        die("El archivo es demasiado grande. El tamaño máximo permitido es de 2MB.");
    }

    // Ruta de almacenamiento para la imagen
    $uploadFileDir = 'uploads/';
    $dest_path = $uploadFileDir . $fileName;

    // Mover la imagen al directorio de destino
    if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $imagen = $dest_path; // Guardar la ruta de la imagen en la base de datos
    } else {
        die('Error al subir la imagen. Intente nuevamente.');
    }
} else {
    die('Error en la carga de la imagen.');
}

// Verificar si el producto ya existe en la BD
$query = "SELECT * FROM productos WHERE nombre = ? AND marca = ? AND modelo = ?";
$stmt = $link->prepare($query);
$stmt->bind_param('sss', $nombre, $marca, $modelo);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<script>alert("El producto ya existe en la base de datos.");</script>';
} else {
    // Insertar el producto en la BD
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 0)";
    $stmt = $link->prepare($sql);
    $stmt->bind_param('sssdiss', $nombre, $marca, $modelo, $precio, $detalles, $unidades, $imagen);

    if ($stmt->execute()) {
        // Mostrar resumen de los datos insertados
        echo "<h2>Producto Insertado Correctamente</h2>";
        echo "<p><strong>Nombre:</strong> $nombre</p>";
        echo "<p><strong>Marca:</strong> $marca</p>";
        echo "<p><strong>Modelo:</strong> $modelo</p>";
        echo "<p><strong>Precio:</strong> $precio</p>";
        echo "<p><strong>Detalles:</strong> $detalles</p>";
        echo "<p><strong>Unidades:</strong> $unidades</p>";
        echo "<p><strong>Imagen:</strong> <img src='$imagen' width='150'></p>";
    } else {
        echo '<script>alert("No se pudo insertar el producto. Error: ' . $stmt->error . '");</script>';
    }
}

$stmt->close();
$link->close();
?>
