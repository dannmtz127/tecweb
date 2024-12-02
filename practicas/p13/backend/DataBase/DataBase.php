<?php
    namespace TECWEB\DB;
    abstract class DataBase {
        protected $conexion;
        protected $data;

        public function __construct($user, $pass, $db) {
            $this->conexion = @mysqli_connect(
                'localhost',
                'root',
                '123456789a',
                'marketzone'
            );
            $this->data = array();
            # Esto es para validar que si se realice la conexión
            #if(!$this->conexion)
            #    $this->conexion = Null;
        }

        public function getData(){
            return json_encode($this->data, JSON_PRETTY_PRINT);
        }
    }
?>