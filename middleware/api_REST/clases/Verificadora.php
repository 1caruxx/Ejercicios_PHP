<?php

    class Verificadora {

        public function VerficarUsuario($request, $response , $next) {

            if($request->isget()) {

                $response->getBody()->write("Pasa.\n");
                $response = $next($request, $response);
            }

            else {

                if($request->ispost()) {
                
                    
                    $usuarioEncabezado = $request->getParsedBody();
                
                    $response->getBody()->write("Pasa.\n");
                
                    $encontrado = VerificarExistenciaDesdeArchivo($usuarioEncabezado["nombre"] , $usuarioEncabezado["perfil"]);
                
                    if($encontrado) {
                
                        $response = $next($request, $response);
                    }
                    else {
                
                        $response->getBody()->write("Usuario inexistente.\n");
                    }
                
                        
                }
            }
            else {
                
                $response->getBody()->write("No pasa, solo GET o POST.\n");
            }
        }
                
            return $response;
        }

        

        private static function VerificarExistenciaDesdeArchivo($nombre , $perfil) {

            $encontrado = false;

            if(!@ $archivo = fopen("./archivo/usuarios.txt" , "r")) {
                
                $response->getBody()->write("No se ha podido abrir el archivo.\n");
            }
            else {
                
                $usuario = array();
                
                while(!feof($archivo)) {
                
                    $usuario = explode(" - " , fgets($archivo));
                
                    if(trim($usuario[0])==$nombre && trim($usuario[1])==$perfil) {
                                            
                        $encontrado = true;
                        break;
                    }
                }

                fclose($archivo);

                return $encontrado;
        }

        private static function VerificarExistenciaDesdeBase() {
            
        }
    }


?>