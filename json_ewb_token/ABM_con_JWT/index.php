<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    use \Firebase\JWT\JWT;

    require_once './vendor/autoload.php';
    require_once './clases/Archivo.php';
    require_once './clases/Base_de_datos.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    $app->add(function($request , $response , $next) {

        $usuario = $request->getParsedBody();

        switch ($request) {

            case $request->isGet():

                $response = $next($request , $response);
                break;

            case $request->isPost():
            case $request->isPut():

                if($usuario["correo"]=="" || $usuario["clave"]=="" || $usuario["nombre"]=="") {

                    $response->getBody()->write("Todos los campos deben ser completados.");
                }
                else {

                    $response = $next($request , $response);
                }
                break;

            case $request->isDelete():
            
                if($usuario["correo"]=="") {

                    $response->getBody()->write("Debe introducir el correo del usuario que quiere eliminar.");
                }
                else {

                    $response = $next($request , $response);
                }
        }

        return $response;
    });

    $app->group("/archivo" , function() {

        $this->get("/listar" , function(Request $request , Response $response) {

            Archivo::Listar($request , $response);
        });

        $this->post("/alta" , function(Request $request , Response $response) {

            Archivo::Agregar($request , $response , $_FILES);
        })->add(\Archivo::class . ":VerificarQueNoExista");

        $this->delete("/baja" , function($request , $response) {

            Archivo::Eliminar($request , $response);
        })->add(\Archivo::class . ":VerificarExistencia");

        $this->put("/modificacion" , function($request , $response) {

            Archivo::Modificar($request , $response , $_FILES);
        })->add(\Archivo::class . ":VerificarExistencia");
    });

    $app->post(["/JWT[/]"] , function(Request $request , Response $response) {

        Archivo::VerificarExistencia($request , $response , $next);
    });

    /*$app->group("/BD" , function() {

        $this->get("/listar" , function(Request $request , Response $response) {

            Archivo::Listar($request , $response);
        });
            
        $this->post("/alta" , function(Request $request , Response $response) {
            
            Archivo::Agregar($request , $response , $_FILES);
        })->add(\Archivo::class . ":VerificarQueNoExista");
            
        $this->delete("/baja" , function($request , $response) {
            
            Archivo::Eliminar($request , $response);
        })->add(\Archivo::class . ":VerificarExistencia");
            
        $this->put("/modificacion" , function($request , $response) {
            
            Archivo::Modificar($request , $response , $_FILES);
        })->add(\Archivo::class . ":VerificarExistencia");

    });*/

    $app->run();
?>