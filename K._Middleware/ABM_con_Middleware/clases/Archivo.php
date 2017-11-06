<?php

    require_once "./clases/Usuario.php";

    class Archivo {

        private static function ObtenerListado($response) {

            $retorno = array();

            if(!@ $archivo = fopen("./archivo/usuarios.txt" , "r")) {

                $response->getBody()->write("No se ha podido abrir el archivo.");
            }
            else {

                $usuario = array();
                $listaDeUsuarios = array();
                $contador = 0;

                while(!feof($archivo)) {

                    $usuario = explode(" - " , trim(fgets($archivo)));

                    if($usuario[0] != "") {

                        array_push($listaDeUsuarios , new Usuario($usuario[0] , $usuario[1] , $usuario[2] , $usuario[3]));
                    }
                }

                fclose($archivo);

                $retorno["usuarios"] = $listaDeUsuarios;
                $retorno["response"] = $response;

                return $retorno;
            }
        }

        public function VerificarExistencia($request , $response , $next) {

            $usuario = $request->getParsedBody();
            $listado = Archivo::ObtenerListado($response);
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

        public function VerificarQueNoExista($request , $response , $next) {

            $usuario = $request->getParsedBody();
            $listado = Archivo::ObtenerListado($response);
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

        public function Listar($request , $response) {

            $listado = Archivo::ObtenerListado($response);
            $listaDeUsuarios = $listado["usuarios"];
            $response = $listado["response"];

            $stringAuxiliar = "<table border='1'>
                                   <tbody>
                                       <thead>
                                           <th>Nombre</th>
                                           <th>Correo</th>
                                           <th>Clave</th>
                                           <th>Foto</th>
                                       </thead>";

            foreach($listaDeUsuarios as $usuario) {

                $stringAuxiliar .= "<tr>
                                        <td>".$usuario->GetNombre()."</td>
                                        <td>".$usuario->GetCorreo()."</td>
                                        <td>".$usuario->GetClave()."</td>
                                        <td><img src='../img/".trim($usuario->GetFoto())."' width='50px' height='50px'/></td>
                                    </tr>";
            }

            $stringAuxiliar .= "</tbody>
                            </table>";

            $response->getBody()->write($stringAuxiliar);

            return $response;
        }

        public static function Agregar($request , $response , $_AR) {

            if(!@ $archivo = fopen("./archivo/usuarios.txt" , "a")) {

                $response->getBody()->write("No se ha podido abrir el archivo.");
            }
            else {

                $usuario = $request->getParsedBody();
                $nombreFoto = date("Gis").".".pathinfo($_AR["foto"]["name"] , PATHINFO_EXTENSION);
                $rutaFoto = "./img/".$nombreFoto;

                fwrite($archivo , (new Usuario($usuario["correo"] , $usuario["clave"] , $usuario["nombre"] , $nombreFoto))->ToString());
                move_uploaded_file($_AR["foto"]["tmp_name"] , $rutaFoto);

                fclose($archivo);

                $response->getBody()->write("Se ha cargado correctamente el nuevo usuario.");
            }

            return $response;
        }

        public static function Eliminar($request , $response) {

            $usuario = $request->getParsedBody();
            $listado = Archivo::ObtenerListado($response);
            $listaDeUsuarios = $listado["usuarios"];
            $response = $listado["response"];
            $contador = 0;

            if(!@ $archivo = fopen("./archivo/usuarios.txt" , "w")) {

                $response->getBody()->write("No se ha podido abrir el archivo.");
            }
            else {

                foreach($listaDeUsuarios as $item) {

                    if($usuario["correo"] == $item->GetCorreo()) {

                        unlink("./img/".$item->GetFoto());
                        unset($listaDeUsuarios[$contador]);
                    }

                    if(isset($listaDeUsuarios[$contador])) {

                        fwrite($archivo , $item->ToString());
                    }

                    $contador++;
                }

                fclose($archivo);
                $response->getBody()->write("Se ha dado de baja correctamente.");
            }

            return $response;
        }

        public static function Modificar($request , $response , $_AR) {

            $usuario = $request->getParsedBody();
            $nombreFoto = date("Gis").".".pathinfo($_AR["foto"]["name"] , PATHINFO_EXTENSION);
            $rutaFoto = "./img/".$nombreFoto;
            $usuario = new Usuario($usuario["correo"] , $usuario["clave"] , $usuario["nombre"] , $nombreFoto);
            $listado = Archivo::ObtenerListado($response);
            $listaDeUsuarios = $listado["usuarios"];
            $response = $listado["response"];
            $contador = 0;

            if(!@ $archivo = fopen("./archivo/usuarios.txt" , "w")) {

                $response->getBody()->write("No se ha podido abrir el archivo.");
            }
            else {

                foreach($listaDeUsuarios as $item) {

                    if($usuario->GetCorreo() == $item->GetCorreo()) {

                        unlink("./img/".$item->GetFoto());
                        move_uploaded_file($_AR["foto"]["tmp_name"] , $rutaFoto);

                        $listaDeUsuarios[$contador] = $usuario;
                    }

                    fwrite($archivo , $listaDeUsuarios[$contador]->ToString());
                    
                    $contador++;
                }

                fclose($archivo);
                $response->getBody()->write("Se ha modificado correctamente.");
            }

            return $response;
        }
    }
?>