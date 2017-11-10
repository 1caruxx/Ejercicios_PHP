<?php

    require_once './vendor/autoload.php';
    use \Firebase\JWT\JWT;

    class Validadora {

        public static function ValidarToken($request , $response , $next , $token) {

            try {
            
                $JWTdecodeado = JWT::decode($token["token"] , "12345" , array('HS256'));
                $response = $next($request , $response);
            }
            catch(Exception $excepcion) {
            
                $response->getBody()->write("Se ha atrapado una excepcion: ".$excepcion->getMessage());
            }
            
            return $response;
        }

        public static function VerificarExistencia($listado , $request , $response , $next) {
            
            $usuario = $request->getParsedBody();
            $listaDeUsuarios = $listado["usuarios"];
            $response = $listado["response"];
            $encontrado = false;
            
            foreach($listaDeUsuarios as $item) {
            
                if($usuario["correo"]==$item->GetCorreo()) {
                        
                    $encontrado = true;
                    break;
                }
            }
                        
            if($encontrado) {
                        
                $response = $next($request , $response);
            }
            else {
                        
                $response->getBody()->write("Usuario inexistente.\n");
            }
                        
            return $response;
        }

        public static function VerificarQueNoExista($listado , $request , $response , $next) {

            $usuario = $request->getParsedBody();
            $listaDeUsuarios = $listado["usuarios"];
            $response = $listado["response"];
            $encontrado = false;

            foreach($listaDeUsuarios as $item) {

                if($usuario["correo"]==$item->GetCorreo()) {

                    $encontrado = true;
                    break;
                }
            }

            if($encontrado) {

                $response->getBody()->write("Este usuario ya fue previamente cargado.\n");
            }
            else {

                $response = $next($request , $response);
            }

            return $response;
        }
    }
?>