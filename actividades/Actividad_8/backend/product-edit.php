<?php
    include_once __DIR__.'/database.php';

    $data = array(
        'status'  => 'error',
        'message' => 'No fue posible actualizar los datos'
    );
    
    if(isset($_POST['obj'])){
        // Como se mando un obj tipo Json
        $jsonOBJ = json_decode($_POST['obj']);
        $sql = "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}', modelo='{$jsonOBJ->modelo}', precio='{$jsonOBJ->precio}', detalles='{$jsonOBJ->detalles}', unidades='{$jsonOBJ->unidades}', imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";
        if ($conexion->query($sql) ){
            $data['status'] = "successful";
            $data['message'] = "Se ha actualizado el producto";        
        }
        // Cierra la conexion
        $conexion->close();
    }   
    else{
        $data['status'] =  "ERROR";
        $data['message'] =  "ocurrió un error con el POST"; 
        
    }
    echo json_encode($data, JSON_PRETTY_PRINT);
?>