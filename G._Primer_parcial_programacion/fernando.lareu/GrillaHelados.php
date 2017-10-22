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

        $helados = Helado::ObtenerHelados();

        $grilla = "<table border='1'>
                        <tbody>
                            <thead>
                                <th>Sabor</th>
                                <th>Precio</th>
                                <th>Imagen</th>
                            </thead>";
        
        foreach($helados as $item) {

            $grilla .= "<tr>
                            <td>".$item->getsabor()."</td>
                            <td>".$item->getprecio()."</td>
                            <td><img src='./heladosImagen/".$item->GetImagen()."' width='50px' height='50px'/></td>
                        </tr>";
        }

        $grilla .= "</tbody>
                </table>";
        echo $grilla;
    ?>
</body>
</html>