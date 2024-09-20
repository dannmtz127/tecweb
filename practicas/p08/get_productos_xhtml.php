<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h3>Lista de Productos</h3>

    <?php
    if (isset($_GET['tope'])) {
        $tope = $_GET['tope'];

        if (!empty($tope)) {
            /** SE CREA EL OBJETO DE CONEXION */
            @$link = new mysqli('localhost', 'root', '123456789a', 'marketzone');

            /** comprobar la conexión */
            if ($link->connect_errno) {
                die('Falló la conexión: ' . $link->connect_error . '<br/>');
            }

            /** Crear una tabla que no devuelve un conjunto de resultados */
            if ($result = $link->query("SELECT * FROM productos WHERE unidades <= $tope")) {
                /** Se verifica si hay resultados */
                if ($result->num_rows > 0) {
                    echo '<table class="table">';
                    echo '<thead class="thead-dark">';
                    echo '<tr>';
                    echo '<th scope="col">#</th>';
                    echo '<th scope="col">Nombre</th>';
                    echo '<th scope="col">Marca</th>';
                    echo '<th scope="col">Modelo</th>';
                    echo '<th scope="col">Precio</th>';
                    echo '<th scope="col">Unidades</th>';
                    echo '<th scope="col">Detalles</th>';
                    echo '<th scope="col">Imagen</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';

                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<th scope="row">' . $row['id'] . '</th>';
                        echo '<td>' . $row['nombre'] . '</td>';
                        echo '<td>' . $row['marca'] . '</td>';
                        echo '<td>' . $row['modelo'] . '</td>';
                        echo '<td>' . $row['precio'] . '</td>';
                        echo '<td>' . $row['unidades'] . '</td>';
                        echo '<td>' . utf8_encode($row['detalles']) . '</td>';
                        echo '<td><img src="' . $row['imagen'] . '" alt="Imagen del Producto" style="width:100px;height:auto;"></td>';
                        echo '</tr>';
                    }

                    echo '</tbody>';
                    echo '</table>';
                } else {
                    echo '<p>No hay productos disponibles para la cantidad especificada.</p>';
                }

                /** liberar memoria */
                $result->free();
            }

            $link->close();
        } else {
            echo '<p>El parámetro "tope" está vacío.</p>';
        }
    } else {
        echo '<p>Parámetro "tope" no detectado...</p>';
    }
    ?>
</body>
</html>
