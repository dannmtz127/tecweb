<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $conexion->query("SELECT * FROM productos WHERE id = '{$id}'") ) {
            // SE OBTIENEN LOS RESULTADOS
			$row = $result->fetch_array(MYSQLI_ASSOC);

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    elseif( isset($_POST['carac']) ) {
        $carac = $_POST['carac'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        #$result = $conexion->query("SELECT id, nombre FROM productos WHERE nombre = '{$id}' LIKE ? LIMIT 0, 5")
        $consulta = "SELECT DISTINCT id, nombre FROM productos 
                        WHERE nombre LIKE '%{$carac}%'
                        OR detalles LIKE '%{$carac}%'
                        OR marca LIKE '%{$carac}%'
                        LIMIT 0, 5";    
        if ($result = $conexion->query($consulta)){
            // SE OBTIENEN LOS RESULTADOS
			//$row = $result->fetch_array(MYSQLI_ASSOC);
            $row = $result->fetch_all(MYSQLI_ASSOC);
            #echo $row;
            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                /*foreach($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }*/
                foreach($row as $num => $registro) {            // Se recorren tuplas
                    foreach($registro as $key => $value) {      // Se recorren campos
                        $data[$num][$key] = ($value);
                    }
                }
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>