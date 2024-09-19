<?php

function esMultiploDe5y7($num) {
    return ($num % 5 == 0 && $num % 7 == 0);
}

function generarSecuenciaImparParImpar() {
    $iteraciones = 0;
    $numGenerados = 0;
    $encontrado = false;
    $secuencias = [];

    while (!$encontrado) {
        $iteraciones++;
        $sec = [];
        $numGenerados += 3;

        for ($i = 0; $i < 3; $i++) {
            $sec[] = rand(100, 999);
        }

        if ($sec[0] % 2 != 0 && $sec[1] % 2 == 0 && $sec[2] % 2 != 0) {
            $encontrado = true;
        }

        $secuencias[] = $sec;
    }
    return [
        'iteraciones' => $iteraciones,
        'numGenerados' => $numGenerados,
        'secuencias' => $secuencias
    ];
}

function encontrarMultiploConWhile($multiplo) {
    $num = rand(1, 1000);
    while ($num % $multiplo != 0) {
        $num = rand(1, 1000);
    }

    return $num;
}

function encontrarMultiploConDoWhile($multiplo) {
    do {
        $num = rand(1, 1000);
    } while ($num % $multiplo != 0);

    return $num;
}

function crearArregloLetras() {
    $arreglo = [];
    for ($i = 97; $i <= 122; $i++) {
        $arreglo[$i] = chr($i);
    }

    return $arreglo;
}

?>
