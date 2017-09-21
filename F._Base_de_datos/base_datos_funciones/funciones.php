<?php

    function SELECT_TODO($base , $tabla , $host="localhost" , $user="root" , $pass="") {

        $conexcion = new MySQLi($host , $user , $pass , $base);
        
            if(!$conexcion) {
        
              echo "Ha ocurrido un error...";
              die();
            }
        
            $SELECT = "SELECT * {$tabla} WHERE 1";
        
            $contenido = $conexcion->query($SELECT);
            $conexcion->close();

            return $contenido;
    }

    function INSERT($base , $tabla , $valor , $valor2 , $host="localhost" , $user="root" , $pass="") {

        $conexcion = new MySQLi($host , $user , $pass , $base);

        if(!$conexcion) {

            echo "Ha ocurrido un error...";
            die();
        }

        $INSERT = "INSERT INTO {$tabla} (valor , valor2) VALUES ({$valor} , {$valor2})";

        $conexcion->query($INSERT);
        $conexcion->close();
    }

    function UPDATE($base , $tabla , $primaryKey , $valor , $valor2 , $host="localhost" , $user="root" , $pass="") {
        
        $conexcion = new MySQLi($host , $user , $pass , $base);
        
        if(!$conexcion) {

            echo "Ha ocurrido un error...";
            die();
        }
        
        $UPDATE = "UPDATE {$tabla} SET valor={$valor} , valor2={$valor2} WHERE primaryKey={$primaryKey}";
        
        $conexcion->query($UPDATE);
        $conexcion->close();
     }
?>