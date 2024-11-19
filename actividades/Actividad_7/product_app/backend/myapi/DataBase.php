<?php
namespace DataBase;
class DataBase {
    protected $conexion;

    public function __construct($user, $pass, $db) {
        $this->conexion = @mysqli_connect(
            'localhost',
            $user,
            $pass,
            $db
        );
        # Esto es para validar que si se realice la conexión
        if(!$this->conexion)
            $this->conexion = Null;
    }
}
?>