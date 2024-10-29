<?php
    // Crear conexión a la base de datos
    $conexion = @mysqli_connect(
        'localhost',      // Servidor
        'root',          // Usuario
        '123456789a', // Contraseña
        'marketzone'     // Nombre de la base de datos
    );

    /**
     * NOTA: si la conexión falló, $conexion contendrá false.
     **/
    if (!$conexion) {
        die('¡Base de datos NO conectada! ' . mysqli_connect_error());
    }
?>
