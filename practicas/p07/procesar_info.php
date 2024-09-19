<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';

    if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
        echo '<h3>Bienvenida, usted está en el rango de edad permitido.</h3>';
    } else {
        echo '<h3>Error: No cumple con los criterios requeridos.</h3>';
    }
} else {
    echo '<h3>Solicitud inválida.</h3>';
}
?>
