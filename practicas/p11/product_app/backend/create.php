<?php
    include_once __DIR__.'/database.php';

    // SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
    $producto = file_get_contents('php://input');
    if(!empty($producto)) {
        // SE TRANSFORMA EL STRING DEL JASON A OBJETO
        $jsonOBJ = json_decode($producto);
        $nombre = $jsonOBJ->nombre;
        $marca  = $jsonOBJ->marca;
        $modelo = $jsonOBJ->modelo;
        $precio = $jsonOBJ->precio;
        $detalles = $jsonOBJ->detalles;
        $unidades = $jsonOBJ->unidades;
        $imagen   = $jsonOBJ->imagen;
        // Primero validamos que no exista un producto con el mismo nombre y que NO este eliminado (0)
        $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND eliminado = '0'";
        if ($result = $conexion->query($sql) ){
            $dat = $result->fetch_array(MYSQLI_ASSOC);
            if(empty($dat)){
                $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
                        VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
                if ($conexion->query($sql) ){
                    $msj = "[Servidor]: Se ha INSERTADO correctamente el producto :D";
                }
                else
                    $msj = "[Servidor]: Ha ocurrido un ERROR al tratar de insertar el producto, intentelo de nuevo :c";
            }
            else
                $msj = "[Servidor]: El producto YA EXISTE y esta activo";
        }
        else
            $msj = "[Servidor]: Ha ocurrido un error al comprobar la existencia del producto :c"; 
        
        
        /**
         * SUSTITUYE LA SIGUIENTE LÍNEA POR EL CÓDIGO QUE REALICE
         * LA INSERCIÓN A LA BASE DE DATOS. COMO RESPUESTA REGRESA
         * UN MENSAJE DE ÉXITO O DE ERROR, SEGÚN SEA EL CASO.
         */
        echo '[SERVIDOR] '. $msj;
    }
?>