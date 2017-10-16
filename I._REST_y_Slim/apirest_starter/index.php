<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require_once './vendor/autoload.php';

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

/*
¡La primera línea es la más importante! A su vez en el modo de 
desarrollo para obtener información sobre los errores
 (sin él, Slim por lo menos registrar los errores por lo que si está utilizando
  el construido en PHP webserver, entonces usted verá en la salida de la consola 
  que es útil).

  La segunda línea permite al servidor web establecer el encabezado Content-Length, 
  lo que hace que Slim se comporte de manera más predecible.
*/

$app = new \Slim\App(["settings" => $config]);

$app->get('[/]', function (Request $request, Response $response) {

    $response->getBody()->write("GET => Bienvenido!!! a SlimFramework");
    return $response;
});

$app->post('[/]', function (Request $request, Response $response) {

    $response->getBody()->write("POST => Bienvenido!!! a SlimFramework");
    return $response;
});

$app->put('[/]', function (Request $request, Response $response) {

    $response->getBody()->write("PUT => Bienvenido!!! a SlimFramework");
    return $response;
});

$app->delete('[/]', function (Request $request, Response $response) {

    $response->getBody()->write("DELETE => Bienvenido!!! a SlimFramework");
    return $response;
});

/*
COMPLETAR POST, PUT Y DELETE
*/

//si no accedo a traves del index.php, tira error de permisos
$app->get('/saludar[/]', function (Request $request, Response $response) {

    $response->getBody()->write("Hola mundo SlimFramework!!!");
    return $response;
});

/*
MAS CODIGO AQUI...
*/

$app->post('/parametros/{nombre}[/{apellido}]', function (Request $request, Response $response , $args) {

    $nombre = $args["nombre"]; 
    $apellido = isset($args["apellido"]) /*? $args["apellido"]:null*/;

    if($apellido) {

        $response->getBody()->write("POST => El nombre que introdujo es: ".$nombre." ".$apellido);
    }
    else {

        $response->getBody()->write("POST => El nombre que introdujo es: ".$nombre);
    }

    return $response;
});

$app->group("/group" , function (){

    $this->get("[/]",function (Request $request, Response $response) {

        $response->getBody()->write("Usted a entrado al group por GET");
        return $response;
    });

    $this->delete("[/]",function (Request $request, Response $response) {
        
        $response->getBody()->write("Usted a entrado al group por DELETE");
        return $response;
    });
});

$app->run();