<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input, textarea, select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php
// Verificar si se recibió el ID del producto para editar
if (!isset($_GET['id'])) {
    die('ID de producto no proporcionado.');
}

$id_producto = $_GET['id'];

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "123456789a";
$dbname = "marketzone";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Chequear conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener los datos del producto
$sql = "SELECT * FROM productos WHERE id = $id_producto";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    die('Producto no encontrado.');
}
?>

    <div class="container">
        <h1>Modificar Producto</h1>
        <form action="update_producto.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required>

            <label for="marca">Marca:</label>
            <input type="text" id="marca" name="marca" value="<?php echo $row['marca']; ?>" required>

            <label for="modelo">Modelo:</label>
            <input type="text" id="modelo" name="modelo" value="<?php echo $row['modelo']; ?>" required>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" value="<?php echo $row['precio']; ?>" required>

            <label for="detalles">Detalles del Producto:</label>
            <textarea id="detalles" name="detalles" rows="4"><?php echo $row['detalles']; ?></textarea>

            <label for="unidades">Unidades en Inventario:</label>
            <input type="number" id="unidades" name="unidades" value="<?php echo $row['unidades']; ?>" required>

            <label for="imagen">Subir Imagen (opcional):</label>
            <input type="file" id="imagen" name="imagen">
            
            <p><strong>Imagen actual:</strong></p>
            <img src="<?php echo !empty($row['imagen']) ? $row['imagen'] : 'ruta/a/imagen_por_defecto.png'; ?>" alt="Imagen del producto" width="150">

            <button type="submit">Actualizar Producto</button>
        </form>
    </div>

<?php
// Cerrar conexión
$conn->close();
?>

</body>
</html>
