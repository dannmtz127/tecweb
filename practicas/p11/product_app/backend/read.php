<?php
include_once __DIR__.'/database.php';

// SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
$data = array();
// SE VERIFICA HABER RECIBIDO EL ID
if (isset($_POST['search'])) {
    $search = $_POST['search'];

    // SE REALIZA LA QUERY DE BÚSQUEDA
    $query = "SELECT * FROM productos WHERE nombre LIKE '%{$search}%' 
              OR marca LIKE '%{$search}%' 
              OR detalles LIKE '%{$search}%'";
    
    if ($result = $conexion->query($query)) {
        // SE OBTIENEN LOS RESULTADOS
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
            $data[] = array(
                'id' => utf8_encode($row['id']),
                'nombre' => utf8_encode($row['nombre']),
                'marca' => utf8_encode($row['marca']),
                'detalles' => utf8_encode($row['detalles'])
            );
        }
        $result->free();
    } else {
        die('Query Error: ' . mysqli_error($conexion));
    }
    $conexion->close();
}

// SE HACE LA CONVERSIÓN DE ARRAY A JSON
echo json_encode($data, JSON_PRETTY_PRINT);
?>
