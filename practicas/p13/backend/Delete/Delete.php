<?php
    namespace TECWEB\DELETE;
    use TECWEB\DB\DataBase;
    #include_once __DIR__.'/../DataBase/DataBase.php';
    include_once __DIR__.'/../../vendor/autoload.php';
    class Delete extends DataBase{

        public function __construct($db, $user = 'root', $pass='1234') {
            parent::__construct($user, $pass, $db);
        }

        public function delete($id) {
            $this->data = array(
                'status'  => 'error',
                'message' => 'La consulta falló'
            );
            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
            if ( $this->conexion->query($sql) ) {
                $this->data['status'] =  "success";
                $this->data['message'] =  "Producto eliminado";
            } else {
                $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }


?>