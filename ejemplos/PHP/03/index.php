<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name>
        <title>Ejemplo 3</title>
    </head>
    <body>
        <?php
        use EJEMPLO\POO\Cabecera2 as Cabecera;
        require_once __DIR__ . '/Cabecera.php';

        $cab = new Cabecera('El rincon del programador', 'center', 'https//cs.buap.mx');
        $cab->graficar();

        ?>
    </body>
</html>