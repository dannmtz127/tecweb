<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN http://www.w3.org/TR/xhtml1/DTD/xhtml1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Busca tus productos</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style type="text/css">
            div{
                margin-left: 25%;
                margin-top: 12%;
                width: 50%; 
                height: 70%;
                border-style: dashed;
                border-color: white;
                background-color: #DFD3C3;
            }
            h1{
                text-align: center;
            }
        </style>
	</head>
	<body>
        <div>
            <?php
                #if(isset($_GET['nombre']) && isset($_GET['marca']) && isset($_GET['modelo']) && isset($_GET['precio']) && isset($_GET['unidades']) && isset($_GET['detalles']) && isset($_GET['img'])){
                if(isset($_POST['precio']) && isset($_POST['unidades'])){
                    $nombre = $_POST['nombre'];
                    $marca  = $_POST['marca'];
                    $modelo = $_POST['modelo'];
                    $precio = $_POST['precio'];
                    $detalles = $_POST['detalles'];
                    $unidades = $_POST['unidades'];
                    $imagen   = $_POST['img'];

                    
                    /** SE CREA EL OBJETO DE CONEXION */
                    @$link = new mysqli('localhost', 'root', '123456789a', 'marketzone');	

                    /** comprobar la conexión */
                    if($link->connect_errno) 
                    {
                        die('Falló la conexión: '.$link->connect_error.'<br/>');
                        
                        /** NOTA: con @ se suprime el Warning para gestionar el error por medio de código */
                    }

                    /** Crear una tabla que no devuelve un conjunto de resultados */
                    $sql = "SELECT * FROM productos WHERE nombre = '$nombre' AND modelo = '$modelo' AND marca = '$marca'";
                    if ($result = $link->query($sql) ){
                        $dat = $result->fetch_array(MYSQLI_ASSOC);
                        if(empty($dat)){
                            #$sql = "INSERT INTO productos VALUES (null, '{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}', '0')";
                            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
                            VALUES ('{$nombre}', '{$marca}', '{$modelo}', {$precio}, '{$detalles}', {$unidades}, '{$imagen}')";
                            if ($link->query($sql) ){
                ?>
                        <h1>Datos ingresados:</h1>

                        <p>
                            <strong>Nombre:</strong> <? echo $nombre ?> <br/>
                            <strong>Marca:</strong> <? echo $marca ?> <br/>
                            <strong>Modelo:</strong> <? echo $modelo ?> <br/>
                            <strong>Precio:</strong> <? echo $precio ?> <br/>
                            <strong>No. de Unidades:</strong> <? echo $unidades ?> <br/>
                            <strong>Dirección imagen:</strong> <? echo $imagen ?> <br/>
                            <strong>Detalles:</strong> <? echo $detalles ?>
                        </p>
                <?php
                            }
                            else{
                ?>
                            <h1>Los datos NO puedieron ser ingresados:</h1>
                            <p>
                                Hubo un problema al tratar de <strong>GUARDAR</strong> los datos, intentelo de nuevo por favor :D
                            </p>
                <?php
                            }
                        }
                        else{
                ?>
                            <h1>Los datos NO puedieron ser ingresados:</h1>
                            <p>
                                El producto "<strong> <? echo $nombre ?> </strong>" tiene considencias con la información ya almacenada, intentelo de nuevo con otros dato, por favor :D
                            </p>
                <?php
                        }
                    }
                    else{
                        echo "No se pudo realizar la consulta SQL D:";
                    }

                    $link->close();
                }
                else{
                    die('Parametros no detectados..');
                    header("formulario_productos.html");
                }
            ?>        
        </div>
	</body>
</html>