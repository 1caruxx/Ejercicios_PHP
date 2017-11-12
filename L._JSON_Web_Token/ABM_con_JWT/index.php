<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listado de Usuarios</title>

    <script src="./vendor/jquery/dist/jquery.min.js"></script>
    <script src="./vendor/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="./vendor/bootstrapvalidator/dist/js/bootstrapValidator.min.js"></script>
    <link rel="stylesheet" href="./vendor/bootstrap/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="./src/FRONTEND/estilos.css"/>
</head>
<body>
    <div class="container">

        <div style="background-color:white;">

            <h4>Usuarios</h4>
            <div class="table-responsive">
                <table class="table">
                    <tr>
                        <th>Perfil</th>
                        <th>Correo</th>
                        <th>Clave</th>
                        <th>Imagen</th>
                        <th>Accion</th>
                    </tr>

                    <?php
                        
                        require_once "./src/BACKEND/clases/Usuario.php";
                        require_once "./src/BACKEND/clases/Archivo.php";
                        require_once "./src/BACKEND/clases/BaseDeDatos.php";

                        $listado = BaseDeDatos::ObtenerListado();
                        $listaDeUsuarios = $listado["usuarios"];
                        $response = $listado["response"];
                        
                        $stringAuxiliar = "";
                        
                        foreach($listaDeUsuarios as $usuario) {
                        
                            $stringAuxiliar .= "<tr>
                                                    <td>".$usuario->GetPerfil()."</td>
                                                    <td>".$usuario->GetCorreo()."</td>
                                                    <td>".$usuario->GetClave()."</td>
                                                    <td><img src='./src/BACKEND/img/".trim($usuario->GetFoto())."' width='50px' height='50px'/></td>
                                                    <td><button type='button' class='btn btn-danger'>Eliminar</button><td><button type='button' class='btn btn-warning'>Modificar</button></td>
                                                </tr>";
                        }

                        echo $stringAuxiliar;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>