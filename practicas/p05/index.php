<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8" />
    <title>Práctica de PHP</title>
</head>
<body>

<h1>Práctica de PHP</h1>

<h2>Ejercicio 1: Validación de Variables</h2>
<?php
// Variables para validar
$valid_vars = [
    '$_myvar' => 'Válida',
    '$_7var' => 'Válida',
    'myvar' => 'Válida',
    '$myvar' => 'Válida',
    '$var7' => 'Válida',
    '$_element1' => 'Válida',
    '$house*5' => 'Inválida',
];

foreach ($valid_vars as $var => $status) {
    echo "<p><strong>$var</strong> es $status.</p>";
}
?>

<h2>Ejercicio 2: Mostrar Valores de Variables</h2>
<?php
$a = "ManejadorSQL";
$b = 'MySQL';
$c = &$a;

echo "<p>\$a: $a</p>";
echo "<p>\$b: $b</p>";
echo "<p>\$c: $c</p>";

$a = "PHP server";
$b = &$a;

echo "<p>Después de asignaciones:</p>";
echo "<p>\$a: $a</p>";
echo "<p>\$b: $b</p>";
echo "<p>\$c: $c</p>";
?>

<h2>Ejercicio 3: Mostrar Valores y Tipos de Variables</h2>
<?php
$a = "PHP5";
$z[] = &$a;
$b = "5a version de PHP";
$c = $b * 10;
$a .= $b;
$b *= $c;
$z[0] = "MySQL";

echo "<p>\$a: $a</p>";
echo "<p>\$b: $b</p>";
echo "<p>\$c: $c</p>";
echo "<p>\$z[0]: $z[0]</p>";
echo "<pre>";
print_r($z);
echo "</pre>";
?>

<h2>Ejercicio 4: Uso de \$GLOBALS</h2>
<?php
$a = "PHP5";
$z[] = &$a;
$b = "5a version de PHP";
$c = $b*10;
$a .= $b;
$b *= $c;
$z[0] = "MySQL";

echo "<p>\$a: " . $GLOBALS['a'] . "</p>";
echo "<p>\$b: " . $GLOBALS['b'] . "</p>";
echo "<p>\$c: " . $GLOBALS['c'] . "</p>";
echo "<p>\$z[0]: " . $GLOBALS['z'][0] . "</p>";
echo "<pre>";
print_r($GLOBALS['z']);
echo "</pre>";
?>

<h2>Ejercicio 5: Valores de Variables con Conversión de Tipos</h2>
<?php
$a = "7 personas";
$b = (integer) $a;
$a = "9E3";
$c = (double) $a;

echo "<p>\$a: $a</p>";
echo "<p>\$b: $b</p>";
echo "<p>\$c: $c</p>";
?>

<$b);
$e = ($a AND $c);
$f = ($a XOR $b);

echo "<p>\$a: ";
var_dump($a);
echo "</p>";

echo "<p>\$b: ";
var_dump($b);
echo "</p>";

echo "<p>\$c: ";
var_dump($c);
echo "</p>";

echo "<p>\$d: ";
var_dump($d);
echo "</p>";

echo "<p>\$e: ";
var_dump($e);
echo "</p>";

echo "<p>\$f: ";
var_dump($f);
echo "</p>";

echo "<p>\$c: " . ($c ? 'true' : 'false') . "</p>";
echo "<p>\$e: " . ($e ? 'true' : 'false') . "</p>";
?>

<h2>Ejercicio 7: Información del Servidor y del Navegador</h2>
<?php
echo "<p><strong>Versión de Apache:</strong> " . (isset($_SERVER['SERVER_SOFTWARE']) ? $_SERVER['SERVER_SOFTWARE'] : 'No disponible') . "</p>";
echo "<p><strong>Versión de PHP:</strong> " . phpversion() . "</p>";

echo "<p><strong>Sistema Operativo del Servidor:</strong> Información no disponible directamente.</p>";

echo "<p><strong>Idioma del Navegador:</strong> " . (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? $_SERVER['HTTP_ACCEPT_LANGUAGE'] : 'No disponible') . "</p>";
?>

</body>
</html>
