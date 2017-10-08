<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Grilla</title>
</head>
<body>
    <?php

        require_once "./Helado.php";

        $lista = Helado::TraerHelados();

        $string = "<table>
                        <tbody>
                            <thead>
                                <th>Sabor</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                            </thead>";

                                foreach($lista as $item) {

                                    $string .= "<tr>
                                                    <td>".$item->getsabor()."</td>
                                                    <td>".$item->PrecioMasIva()."</td>
                                                    <td><img src'./archivos/'".$item->getfoto()."/></td>
                                                </tr>"

                                }

             $string .= "</tbody>
                    </table>";





    ?>
</body>
</html>
