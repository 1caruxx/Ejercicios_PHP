<?php

    //Gestion de las variables de peticion y de respuesta.
    use \Psr\Http\Message\ServerRequestInterface as Request;
    use \Psr\Http\Message\ResponseInterface as Response;

    //Carga de los componentes necesarios para Slim.
    require_once './vendor/autoload.php';

    //Seteo de configuraciones: displayErrorDetails permite ver error, devuelve un valor binario, si hubo exito devuelve true, si no encuentra la pagina (por diversos motivos) retornara false.
    $config['displayErrorDetails'] = true;
    $config['addContentLengthHeader'] = false;

    //Genero la instancia de Slim con la que podre utilizar los distintos verbos.
    $app = new \Slim\App(["settings" => $config]);

    //Ejecuto los verbos.
    $app->run();
?>