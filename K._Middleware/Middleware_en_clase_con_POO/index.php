<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once './vendor/autoload.php';
    require_once './clases/Verificadora.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    $app->get('[/]' , function (Request $request, Response $response) {

        echo "GET\n";
        return $response;
    });

    $app->post('[/]' , function (Request $request, Response $response) {

        echo "POST\n";
        return $response;
    });

    $app->put('[/]' , function (Request $request, Response $response) {

        echo "PUT\n";
        return $response;
    });

    $app->delete('[/]' , function (Request $request, Response $response) {

        echo "DELETE\n";
        return $response;
    });

    $middleWare = function($request, $response , $next) {
  
        $response->getBody()->write("Dentro de la funcion middleware pero antes de que se ejecute el verbo de mi API.\n");
        $response = $next($request, $response);
        $response->getBody()->write("Dentro de la funcion middleware despues de que se ejecute el verbo de mi API.");
        
        return $response;
    };
        
    $app->add($middleWare);

    $app->post('/root[/]' , function(Request $request, Response $response) {

        echo "Funcion POST ruteada\n";
        return $response;
    })->add(function($request, $response , $next) {

        $response->getBody()->write("Dentro de la funcion particular del POST antes de que se ejecute.\n");
        $response = $next($request, $response);
        $response->getBody()->write("Dentro de la funcion particular del POST luego de que se ejecute.\n");

        return $response;

    });

    $app->group('/grupo' , function() {

        $this->get('[/]' , function(Request $request, Response $response) {

            echo "El GET que esta dentro del grupo.\n";
            return $response;
        });

        $this->get('/get[/]' , function(Request $request, Response $response) {

            echo "El GET que esta dentro del grupo al que se le asigna una funcion MiddleWare.\n\n";
        })->add(function($request, $response , $next) {

            $response->getBody()->write("Funcion MiddleWare particular del verbo del grupo (antes).\n\n");
            $response = $next($request, $response);
            $response->getBody()->write("Funcion MiddleWare particular del verbo del grupo (despues).\n");
    
            return $response;
        });
    })->add(function($request, $response , $next) {

        $response->getBody()->write("Funcion MiddleWare particular del grupo (antes).\n");
        $response = $next($request, $response);
        $response->getBody()->write("Funcion MiddleWare particular del grupo (despues).\n");

        return $response;
    });

    $app->group('/credenciales' , function() {

        $this->get('/get[/]' , function(Request $request, Response $response) {

            echo "dentro del GET\n";

            return $response;
        });

        $this->post('/post[/]' , function(Request $request, Response $response) {

            $array = $request->getParsedBody();

            $response->getBody()->write("Nombre: ".$array["nombre"]."\n"."Perfil: ".$array["perfil"]."\n");
            
            return $response;
        });
        /*
         * \Verificadora::class tiene la funcion de crear una instancia de la clase en el momento.
         * . ":VerficarUsuario" me permite acceder al metodo que esta entrecomillado.
         */
    })->add(\Verificadora::class . ":VerficarUsuario");

    $app->run();

?>