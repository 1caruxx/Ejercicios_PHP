<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 36</title>
</head>
<body>
    <table border="1">
        <tbody>
            <thead>
                <th>Nombre</th>
                <th>Imagen</th>
            </thead>

            <?php

                $ruta = "";

                foreach(scandir("./img") as $item) {

                    if($item=="." || $item=="..") {

                        continue;
                    }

                    $imagen = "./img/".$item;
                    $pagina = "./admin.php?ruta=".$imagen;

                    echo "<tr>
                            <td>{$item}</td>
                            <td><a href='{$pagina}'><img src='{$imagen}' width='100px' height='100px' /></a></td>
                          </tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>