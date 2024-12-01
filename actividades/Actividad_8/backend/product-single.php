<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM productos WHERE id = '{$id}'";
        $result = $conexion->query($sql);
        if(!$result){
            die('EEROR');
        }
        $json = array();
        while($row = mysqli_fetch_array($result)){
            $json[] = array(
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'precio' => $row['precio'],
            'unidades' => $row['unidades'],
            'modelo' => $row['modelo'],
            'marca' => $row['marca'],
            'detalles' => $row['detalles'],
            'imagen' => $row['imagen']);
        };
        

        $result->free();
        // Cierra la conexion
        $conexion->close();
    }
    echo json_encode($json[0], JSON_PRETTY_PRINT);
?>