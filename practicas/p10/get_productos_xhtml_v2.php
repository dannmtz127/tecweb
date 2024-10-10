<?php
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

// Consulta para obtener los productos con 50 unidades o menos
$sql = "SELECT id, nombre, marca, modelo, precio, detalles, unidades, imagen FROM productos WHERE unidades <= 50";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%; text-align: center;'>";
    echo "<tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Precio</th>
            <th>Detalles</th>
            <th>Unidades</th>
            <th>Imagen</th>
            <th>Editar</th>
        </tr>";
    
    // Imagen por defecto
    $default_image = "LogoLEGO.png"; // Aquí colocas la ruta a tu imagen por defecto
    
    // Mostrar productos
    while ($row = $result->fetch_assoc()) {
        $imagen = !empty($row['imagen']) ? $row['imagen'] : $default_image; // Si no hay imagen, usar la por defecto
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nombre']}</td>
                <td>{$row['marca']}</td>
                <td>{$row['modelo']}</td>
                <td>{$row['precio']}</td>
                <td>{$row['detalles']}</td>
                <td>{$row['unidades']}</td>
                <td><img src='{$imagen}' alt='Imagen del producto' width='100'></td>
                <td><a href='formulario_productos_v2.php?id={$row['id']}'>Editar</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron productos con 50 unidades o menos.";
}

// Cerrar conexión
$conn->close();
?>
