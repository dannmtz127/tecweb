<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "123456789a";
    $dbname = "marketzone";

    // Crear conexión
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verificar conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Recibir los datos del formulario
    $nombre = $_POST['nombre'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $precio = $_POST['precio'];
    $detalles = $_POST['detalles'];
    $unidades = $_POST['unidades'];
    
    // Procesar la imagen
    $imagen = "imagenes_subidas/imagen_por_defecto.png"; // Ruta por defecto
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $imagen_tmp = $_FILES['imagen']['tmp_name'];
        $imagen_nombre = basename($_FILES['imagen']['name']);
        $ruta_destino = "imagenes_subidas/" . $imagen_nombre; // Ruta correcta en el servidor

        // Mover el archivo cargado a la ruta de destino
        if (move_uploaded_file($imagen_tmp, $ruta_destino)) {
            $imagen = $ruta_destino; // Ruta de la imagen subida
        } else {
            echo "Error al mover la imagen.";
        }
    }

    // Consulta SQL para insertar el nuevo producto
    $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
            VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen')";

    // Ejecutar la consulta
    if ($conn->query($sql) === TRUE) {
        echo "<h3>Producto agregado exitosamente.</h3>";
    } else {
        echo "<h3>Error al agregar el producto: " . $conn->error . "</h3>";
    }

    // Cerrar conexión
    $conn->close();
}
?>

<!-- Botones para regresar o ver productos -->
<div>
    <form action="formulario_productos_v2.html" method="get">
        <button type="submit">Insertar otro producto</button>
    </form>
    <form action="get_productos_vigente_v2.php" method="get">
        <button type="submit">Ver todos los productos</button>
    </form>
</div>
