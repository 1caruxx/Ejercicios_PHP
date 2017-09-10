<?php

    function GenerarTabla($base , $altura) {

        echo "<table border='1'>";
        echo "<tbody>";

        for($i=0 ; $i<$altura ; $i++) {

            echo  "<tr>";

            for($j=0 ; $j<$base ; $j++) {

                echo "<td>Soy negro</td>";
            }

            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    }
?>