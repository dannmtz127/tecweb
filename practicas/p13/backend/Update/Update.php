<?php
    namespace TECWEB\UPDATE;
    use TECWEB\DB\DataBase;
    #include_once __DIR__.'/../DataBase/DataBase.php';
    include_once __DIR__.'/../../vendor/autoload.php';
    class Update extends DataBase{

        public function __construct($db, $user = 'root', $pass='1234') {
            parent::__construct($user, $pass, $db);
        }

        public function edit($obj) {
            $this->data = array(
                'status'  => 'error',
                'message' => 'La consulta falló'
            );
            $jsonOBJ = json_decode( json_encode($obj) );
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql =  "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
            $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',"; 
            $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";
            $this->conexion->set_charset("utf8");
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto actualizado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }


?>