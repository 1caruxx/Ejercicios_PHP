<?php

    function SELECT_TODO($base , $tabla , $host="localhost" , $user="root" , $pass="") {

        $conexcion = new MySQLi($host , $user , $pass , $base);
        
            if(!$conexcion) {
        
              echo "Ha ocurrido un error...";
              die();
            }
        
            $SELECT = "SELECT * FROM {$tabla} WHERE 1";
        
            $contenido = $conexcion->query($SELECT);
            $conexcion->close();

            return $contenido;
    }

    function INSERT($base , $tabla , $nombre , $path_photo , $host="localhost" , $user="root" , $pass="") {

        $conexcion = new MySQLi($host , $user , $pass , $base);

        if(!$conexcion) {

            echo "Ha ocurrido un error...";
            die();
        }

        $INSERT = "INSERT INTO {$tabla} (nombre , path_photo) VALUES ('{$nombre}' , '{$path_photo}')";

        $conexcion->query($INSERT);
        $conexcion->close();
    }

    function UPDATE($base , $tabla , $primaryKey , $nombre , $path_photo , $host="localhost" , $user="root" , $pass="") {
        
        $conexcion = new MySQLi($host , $user , $pass , $base);
        
        if(!$conexcion) {

            echo "Ha ocurrido un error...";
            die();
        }
        
        $UPDATE = "UPDATE {$tabla} SET nombre={$nombre} , path_photo={$path_photo} WHERE primaryKey={$primaryKey}";
        
        $conexcion->query($UPDATE);
        $conexcion->close();
     }
?>