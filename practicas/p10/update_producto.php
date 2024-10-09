<?php
// Conexión a la base de datos
$link = mysqli_connect("localhost", "root", "123456789a", "marketzone");

if ($link === false) {
    die("ERROR: No pudo conectarse. " . mysqli_connect_error());
}

// Obtener los datos enviados por el formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$precio = $_POST['precio'];
$unidades = $_POST['unidades'];

// Sentencia SQL para actualizar el producto
$sql = "UPDATE productos SET nombre='$nombre', marca='$marca', modelo='$modelo', precio=$precio, unidades=$unidades WHERE id=$id";

if (mysqli_query($link, $sql)) {
    echo "Producto actualizado correctamente.";
} else {
    echo "ERROR: No se pudo actualizar el producto. " . mysqli_error($link);
}

// Cerrar conexión
mysqli_close($link);
?>
