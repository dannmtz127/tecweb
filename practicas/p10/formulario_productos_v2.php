<?php
// Conexión a la base de datos
$link = mysqli_connect("localhost", "root", "123456789a", "marketzone");

if ($link === false) {
    die("ERROR: No pudo conectarse. " . mysqli_connect_error());
}

// Obtener el id del producto a editar
$id = $_GET['id'];

// Consulta para obtener la información del producto seleccionado
$sql = "SELECT * FROM productos WHERE id = $id";
$result = mysqli_query($link, $sql);

if ($result && mysqli_num_rows($result) == 1) {
    $producto = mysqli_fetch_assoc($result);
} else {
    die("Producto no encontrado.");
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
</head>
<body>
    <h1>Editar Producto</h1>
    <form action="update_producto.php" method="POST">
        <input type="hidden" name="id" value="<?= $producto['id']; ?>">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?= $producto['nombre']; ?>"><br>

        <label for="marca">Marca:</label>
        <input type="text" name="marca" id="marca" value="<?= $producto['marca']; ?>"><br>

        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" id="modelo" value="<?= $producto['modelo']; ?>"><br>

        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" value="<?= $producto['precio']; ?>"><br>

        <label for="unidades">Unidades:</label>
        <input type="number" name="unidades" id="unidades" value="<?= $producto['unidades']; ?>"><br>

        <input type="submit" value="Actualizar Producto">
    </form>
</body>
</html>
