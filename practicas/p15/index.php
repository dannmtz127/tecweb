<?php
require 'vendor/autoload.php';

$app = new \Slim\App();

$app->get('/', function($request, $response, $args) { 
    $response->write('Hola Mundo Slimm!!!');
    return $response;
});

$app->get('/hola[/{nombre}]', function($request, $response, $args) {
    $nombre = isset($args['nombre']) ? $args['nombre'] : 'Mundo'; 
    $response->write('Hola, ' . $nombre);
    return $response;
});

$app->post('/pruebapost', function($request, $response, $args) {
    $reqPost = $request->getParsedBody();
    $val1 = $reqPost["val1"];
    $val2 = $reqPost["val2"];

    $response->write("Valores:". $val1 ." ". $val2 ."");
    return $response;
});

$app->get("/testjson", function($request, $response, $args) {
    $data[0]["nombre"]="Alan";
    $data[1]["apellidos"]="Trujillo Roldan";
    $data[2]["nombre"]= "Pedro";
    $data[3]["apellidos"]= "Perez Lopez";
    $response->write(json_encode($data, JSON_PRETTY_PRINT));
    return $response;
});

$app->run();