<?php
    namespace TECWEB\CREATE;
    use TECWEB\DB\DataBase;
    #include_once __DIR__.'/../DataBase/DataBase.php';
    include_once __DIR__.'/../../vendor/autoload.php';
    class Create extends DataBase{

        public function __construct($db, $user = 'root', $pass='1234') {
            parent::__construct($user, $pass, $db);
        }

        public function add($obj) {
            $this->data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
            // SE TRANSFORMA EL POST A UN STRING EN JSON, Y LUEGO A OBJETO
            $jsonOBJ = json_decode(json_encode($obj));
            // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                if($this->conexion->query($sql)){
                    $this->data['status'] =  "success";
                    $this->data['message'] =  "Producto agregado";
                } else {
                    $this->data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            }
            $result->free();
            $this->conexion->close();
        }
    }

?>