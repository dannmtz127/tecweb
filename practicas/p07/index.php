<?php
// Incluir el archivo de funciones
include 'src/funciones.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 7</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if (isset($_GET['numero'])) {
            $num = $_GET['numero'];
            if (esMultiploDe5y7($num)) {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            } else {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>

    <h2>Generar secuencias</h2>
    <?php
        $resultado = generarSecuenciaImparParImpar();
        echo '<p>'.$resultado['numGenerados'].' números obtenidos en '.$resultado['iteraciones'].' iteraciones</p>';
        echo '<pre>';
        print_r($resultado['secuencias']);
        echo '</pre>';
    ?>

    <h2>Encontrar múltiplo con while</h2>
    <form action="index.php" method="get">
        <label for="numeroObjetivo">Número objetivo:</label>
        <input type="number" id="numeroObjetivo" name="numeroObjetivo" min="1" required>
        <input type="submit" value="Buscar con while">
    </form>
    <?php
        if (isset($_GET['numeroObjetivo'])) {
            $numeroObjetivo = $_GET['numeroObjetivo'];
            $numeroEncontrado = encontrarMultiploConWhile($numeroObjetivo);
            echo '<p>El primer número entero múltiplo de '.$numeroObjetivo.' (con while) es '.$numeroEncontrado.'.</p>';
        }
    ?>

    <h2>Encontrar múltiplo con do-while</h2>
    <form action="index.php" method="get">
        <label for="numeroObjetivoDoWhile">Número objetivo:</label>
        <input type="number" id="numeroObjetivoDoWhile" name="numeroObjetivoDoWhile" min="1" required>
        <input type="submit" value="Buscar con do-while">
    </form>
    <?php
        if (isset($_GET['numeroObjetivoDoWhile'])) {
            $numeroObjetivoDoWhile = $_GET['numeroObjetivoDoWhile'];
            $numeroEncontradoDoWhile = encontrarMultiploConDoWhile($numeroObjetivoDoWhile);
            echo '<p>El primer número entero múltiplo de '.$numeroObjetivoDoWhile.' (con do-while) es '.$numeroEncontradoDoWhile.'.</p>';
        }
    ?>

    <h2>Crear arreglo de letras</h2>
    <?php
        $arregloLetras = crearArregloLetras();
        echo '<table border="1">';
        foreach ($arregloLetras as $key => $value) {
            echo '<tr><td>'.$key.'</td><td>'.$value.'</td></tr>';
        }
        echo '</table>';
    ?>
</body>
</html>
