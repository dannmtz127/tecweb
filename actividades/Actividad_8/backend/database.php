<?php
    $conexion = @mysqli_connect(
        'localhost',
        'root',
        '123456789a',
        'marketzone'
    );

    /**
     * NOTA: si la conexión falló $conexion contendrá false
     **/
    if(!$conexion) {
        die('¡Base de datos NO conectada!');
    }
?>