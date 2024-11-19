<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<?php
        $data = array();
        /** SE CREA EL OBJETO DE CONEXION */
        @$link = new mysqli('localhost', 'root', '123456789a', 'marketzone');	

        /** comprobar la conexión */
        if ($link->connect_errno) 
        {
            die('Falló la conexión: '.$link->connect_error.'<br/>');
                /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
        }

        if ( $result = $link->query("SELECT * FROM productos WHERE eliminado = '0'") ) 
        {
            /** Se extraen las tuplas obtenidas de la consulta */
            $row = $result->fetch_all(MYSQLI_ASSOC);

            /** Se crea un arreglo con la estructura deseada */
            foreach($row as $num => $registro) {            // Se recorren tuplas
                foreach($registro as $key => $value) {      // Se recorren campos
                    $data[$num][$key] = $value;
                }
            }

            /** útil para liberar memoria asociada a un resultado con demasiada información */
            $result->free();
        }

        $link->close();
	?>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Busca tus productos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	</head>
	<body>
        <div style="align-items: center; width: 89%; margin-left: 5%;">
        <br/>
        <h3 style = "text-align: center">PRODUCTOS</h3>
        <br/>
        <?php if( isset($data) ) : ?>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Unidades</th>
                    <th scope="col">Detalles</th>
                    <th scope="col">Imagen</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            foreach($data as $num => $registro) {            // Se recorren tuplas
                                echo "<tr>";
                                    echo "<th scope='row'>" . $registro['id'] . "</th>";
                                    echo "<td>" . $registro['nombre'] . "</td>";
                                    echo "<td>" . $registro['marca'] . "</td>";
                                    echo "<td>" . $registro['modelo'] . "</td>";
                                    echo "<td>" . $registro['precio'] . "</td>";
                                    echo "<td>" . $registro['unidades'] . "</td>";
                                    echo "<td>" . $registro['detalles'] . "</td>";
                                    echo "<td><img src = \"" . $registro['imagen'] . "\" width = 50% height = 30%  ></td>";
                                echo "</tr>";
                            }
                        ?>
                </tbody>
            </table>

        <?php elseif(!empty($id)) : ?>

            <script>
                alert('El ID del producto no existe');
            </script>

        <?php endif; ?>
        </div>
	</body>
</html>