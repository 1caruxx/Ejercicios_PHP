<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 15</title>
</head>
<body>
    <?php
         require_once "Clases/Rectangulo.php";
         require_once "Clases/Triangulo.php";

         $rectangulo = new Rectangulo(20 , 50);
         $triangulo = new Triangulo(5, 10);

         $rectangulo->SetColor("green");
         $triangulo->SetColor("red");

            echo "<table align='center'>";
                echo "<tr>";
                     echo "<td>";
                        echo "<p style='color:{$rectangulo->GetColor()}'>{$rectangulo->ToString()}</p>";
                     echo "</td>";
                echo "</tr>";
                echo "<tr>";
                    echo "<td style='padding-left:100px'>";
                        echo "<p style='color:{$triangulo->GetColor()}'>{$triangulo->ToString()}</p>";;
                    echo "</td>";
                echo "</tr>";
            echo "</table>";

         /*echo "<p style='color:{$rectangulo->GetColor()}'>{$rectangulo->ToString()}</p>";
         echo "<br/><br/>";
         echo "<p style='color:{$triangulo->GetColor()}'>{$triangulo->ToString()}</p>";*/
    ?>
</body>
</html>


