<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './clases/verificadora.php';

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

//*********************************************************************************************//
//CONFIGURO LOS VERBOS GET, POST, PUT Y DELETE
//*********************************************************************************************//
$app->get('[/]', function (Request $request, Response $response) {    
  $response->getBody()->write("API => GET");
  return $response;

});
$app->post('[/]', function (Request $request, Response $response) {    
  $response->getBody()->write("API => POST");
  return $response;

});
$app->put('[/]', function (Request $request, Response $response) {    
  $response->getBody()->write("API => PUT");
  return $response;

});
$app->delete('[/]', function (Request $request, Response $response) {    
  $response->getBody()->write("API => DELETE");
  return $response;

});

//*********************************************************************************************//
//FUNCION MIDDLEWARE
//*********************************************************************************************//
$mwUno = function($request, $response, $next) {
  //EJECUTO ACCIONES ANTES DE INVOCAR A LA API
  $response->getBody()->write('Antes de ejecutar MiddleWare UNO...<br>');
  //INVOCO A LA API
  $response = $next($request, $response);
  //EJECUTO ACCIONES DESPUES DE INVOCAR A LA API
  $response->getBody()->write('<br>...Despues de ejecutar MiddleWare UNO');

  return $response;
  
};

//*********************************************************************************************//
//AGREGO MIDDLEWARE PARA TODOS LOS VERBOS
//*********************************************************************************************//
$app->add($mwUno);


//*********************************************************************************************//
//AGREGO ROUTE MIDDLEWARE, SOLO PARA PUT
//*********************************************************************************************//
$app->put('/param/', function (Request $request, Response $response) {    
  $response->getBody()->write("API => PUT");
  return $response;

})->add(function ($request, $response, $next) {
  //EJECUTO ACCIONES ANTES DE INVOCAR A LA API
  $response->getBody()->write('Antes de ejecutar Middleware DOS...<br>');
  //INVOCO A LA API
  $response = $next($request, $response);
  //EJECUTO ACCIONES DESPUES DE INVOCAR A LA API
  $response->getBody()->write('<br>...Despues de ejecutar Middleware DOS');

  return $response;
});


//*********************************************************************************************//
//AGREGO GROUP MIDDLEWARE
//*********************************************************************************************//
$app->group('/grupo', function () {
  
  $this->get('/hoy', function (Request $request, Response $response) {
    return $response->getBody()->write(date('Y-m-d'));
  });
   
  $this->get('/hora', function (Request $request, Response $response) {
    return $response->getBody()->write(date('H:i:s'));
  })->add(function($request, $response, $next) {
    //EJECUTO ACCIONES ANTES DE INVOCAR A LA API
    $response->getBody()->write('Antes de ejecutar Middleware CUATRO...<br>');
    //INVOCO A LA API
    $response = $next($request, $response);
    //EJECUTO ACCIONES DESPUES DE INVOCAR A LA API
    $response->getBody()->write('<br>...Despues de ejecutar Middleware CUATRO');

    return $response;
  });

 })->add(function ($request, $response, $next) {
  //EJECUTO ACCIONES ANTES DE INVOCAR A LA API
  $response->getBody()->write('Antes de ejecutar Middleware TRES...<br>');
  //INVOCO A LA API
  $response = $next($request, $response);
  //EJECUTO ACCIONES DESPUES DE INVOCAR A LA API
  $response->getBody()->write('<br>...Despues de ejecutar Middleware TRES');

  return $response;
});


//*********************************************************************************************//
//AGREGO GROUP MIDDLEWARE PARA VERIFICAR CREDENCIALES
//*********************************************************************************************//
$app->group('/credenciales', function () {
  
  $this->get('[/]', function (Request $request, Response $response) {
    return $response->getBody()->write("<br>API => GET<br>");
  });
   
  $this->post('[/]', function (Request $request, Response $response) {
    return $response->getBody()->write("<br>API => POST<br>");
  });
  
 })->add(function ($request, $response, $next) {
  
    if($request->isGet()) {
      $response->getBody()->write('<br>NO necesita credenciales para los get<br>');
      $response = $next($request, $response);
    }
    else{
      $response->getBody()->write('<br>verifico credenciales<br>');
      $ArrayDeParametros = $request->getParsedBody();
      $nombre=$ArrayDeParametros['nombre'];
      $tipo=$ArrayDeParametros['tipo'];
  
      if($tipo=="administrador") {
        $response->getBody()->write("<h3>Bienvenido $nombre </h3>");
        $response = $next($request, $response);
      }
      else{
        $response->getBody()->write('<h2>no tenes habilitado el ingreso</h2>');
      }  
    }
  
    $response->getBody()->write('<br>vuelvo del verificador de credenciales<br>');
    return $response;  
  });


//*********************************************************************************************//
//AGREGO GROUP MIDDLEWARE PARA VERIFICAR CREDENCIALES CON POO
//*********************************************************************************************//
$app->group('/credenciales/POO', function () {
  
  $this->get('[/]', function (Request $request, Response $response) {
    return $response->getBody()->write("<br>API_POO => GET<br>");
  });
   
  $this->post('[/]', function (Request $request, Response $response) {
    return $response->getBody()->write("<br>API_POO => POST<br>");
  });
  
 })->add(\Verificadora::class . ":VerificarUsuario");


//*********************************************************************************************//
//HABILITO CORS PARA TODOS LOS VERBOS
//*********************************************************************************************//
$app->add(function ($request, $response, $next) {
  $response = $next($request, $response);
  return $response
          ->withHeader('Access-Control-Allow-Origin', 'http://localhost:8080')
          ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
          ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


$app->run();