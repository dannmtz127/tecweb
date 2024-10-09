<?php
// Conexión a la base de datos
$link = mysqli_connect("localhost", "root", "123456789a", "marketzone");

if ($link === false) {
    die("ERROR: No pudo conectarse. " . mysqli_connect_error());
}

// Consulta para obtener productos vigentes (puedes cambiar la condición según tus necesidades)
$sql = "SELECT * FROM productos WHERE unidades > 0";
$result = mysqli_query($link, $sql);

if ($result && mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Nombre</th><th>Marca</th><th>Modelo</th><th>Precio</th><th>Unidades</th><th>Editar</th></tr>";

    // Ciclo para recorrer los productos
    while ($producto = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $producto['id'] . "</td>";
        echo "<td>" . $producto['nombre'] . "</td>";
        echo "<td>" . $producto['marca'] . "</td>";
        echo "<td>" . $producto['modelo'] . "</td>";
        echo "<td>" . $producto['precio'] . "</td>";
        echo "<td>" . $producto['unidades'] . "</td>";
        
        // Enlace para editar el producto
        echo "<td><a href='formulario_productos_v2.php?id=" . $producto['id'] . "'>Editar</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No se encontraron productos vigentes.";
}

// Cerrar conexión
mysqli_close($link);
?>
