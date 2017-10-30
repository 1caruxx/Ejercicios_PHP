<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;
    require_once "./clases/Verificadora.php";

    require_once './vendor/autoload.php';

    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    $app = new \Slim\App(["settings" => $config]);

    $app->get('[/]' , function (Request $request, Response $response) {

        echo "GET\n";
        return $response;
    });

    $app->post('[/]' , function (Request $request, Response $response) {

        echo "POST";
        return $response;
    });

    $app->put('[/]' , function (Request $request, Response $response) {

        echo "PUT";
        return $response;
    });

    $app->delete('[/]' , function (Request $request, Response $response) {

        echo "DELETE";
        return $response;
    });

    /*
     * Tambien es posible asignar una funcion MiddleWare a 
     */
    $app->post('/root[/]' , function(Request $request, Response $response) {

        echo "Funcion POST ruteada";
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

            echo "dentro del GET";

            return $response;
        });

        $this->post('/post[/]' , function(Request $request, Response $response) {

            $array = $request->getParsedBody();

            $response->getBody()->write("Nombre: ".$array["nombre"]."\n"."Perfil: ".$array["perfil"]."\n");
            
            return $response;
        });
        // \Verficadora::class genera una instancia de la clase,  ":VerficarUsuario" llamo al metodo
    })->add(\Verificadora::class , ":VerficarUsuario");

    /*
     * Un MiddleWare es un sowftware que esta entre medio de un pedido y de mi api. En nuestro caso seran funciones
     * Esta se ejecutara antes de la llamada a un verbo y luego seguira ejecutandose.
     * Se recomienda que una funcion MiddleWare reciba tres parametros, el pedido, la respuesta y la proxima funcion middleware o el verbo
        * ya que las funciones middleware pueden encadenarse.
     * Una funcion middleware obligatoriamente debera retornar un objeto de tipo
        * \Psr\Http\Message\ResponseInterface que en este caso esta bajo el alias response
        * Lo que quiere decir que mis funciones MiddleWare deberan retornar response.
     */
    $middleWare = function($request, $response , $next) {

        $response->getBody()->write("Dentro de la funcion middleware pero antes de que se ejecute el verbode mi API\n");
        $response = $next($request, $response);
        $response->getBody()->write("Dentro de la funcion middleware despues de que se ejecute el verbode mi API");

        return $response;
    };

    /*
     * Aniado la funcion MiddleWare a mi aplicacion, por lo que se ejecutara por cada llamada a cualquier verbo.
     */
    $app->add($middleWare);
    $app->run();

?>