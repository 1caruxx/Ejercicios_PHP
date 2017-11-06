<?php

    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    require_once './vendor/autoload.php';

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
        
        $response->getBody()->write("Dentro de la funcion middleware pero antes de que se ejecute el verbo de mi API.\n");
        $response = $next($request, $response);
        $response->getBody()->write("Dentro de la funcion middleware despues de que se ejecute el verbo de mi API.");
        
        return $response;
    };
        
    /*
     * Aniado la funcion MiddleWare a mi aplicacion, por lo que se ejecutara por cada llamada a cualquier verbo.
     */
    $app->add($middleWare);

    /*
     * Tambien es posible asignar una funcion MiddleWare a un verbo en particular.
     * El orden de ejecucion de los Middleware sera:
        * Entrada: Del mas general al mas especifico y luego mi API.
        * Salida: Mi API y luego del mas especifico al mas general.  
     */
    $app->post('/root[/]' , function(Request $request, Response $response) {

        echo "Funcion POST ruteada\n";
        return $response;
    })->add(function($request, $response , $next) {

        $response->getBody()->write("Dentro de la funcion particular del POST antes de que se ejecute.\n");
        $response = $next($request, $response);
        $response->getBody()->write("Dentro de la funcion particular del POST luego de que se ejecute.\n");

        return $response;
    });

    /*
     * Aca estoy aniadiendo un Middleware al grupo de vervos y a un verbo contenido por ese grupo
        * El orden seria el siguiente: Middleware de mi aplicacion - Middleware del grupo - Middleware del verbo contenido por el grupo - El verbo en si
        * El verbo en si - Middleware del verbo contenido por el grupo - Middleware del grupo - Middleware de mi aplicacion.
     */
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
    })->add(function($request, $response , $next) {

        if($request->isget()) {

            $response->getBody()->write("Pasa.\n");
            $response = $next($request, $response);
        }
        else {

            if($request->ispost()) {

                $encontrado = false;
                $usuarioEncabezado = $request->getParsedBody();

                $response->getBody()->write("Pasa.\n");

                if(!@ $archivo = fopen("./archivo/usuarios.txt" , "r")) {

                    $response->getBody()->write("No se ha podido abrir el archivo.\n");
                }
                else {

                    $usuario = array();

                    while(!feof($archivo)) {

                        $usuario = explode(" - " , fgets($archivo));

                        if(trim($usuario[0])==$usuarioEncabezado["nombre"] && trim($usuario[1])==$usuarioEncabezado["perfil"]) {
                            
                            $encontrado = true;
                            break;
                        }
                    }

                    if($encontrado) {

                        $response = $next($request, $response);
                    }
                    else {

                        $response->getBody()->write("Usuario inexistente.\n");
                    }

                    fclose($archivo);
                }
            }
            else {

                $response->getBody()->write("No pasa, solo GET o POST.\n");
            }
        }

        return $response;
    });

    $app->run();
?>