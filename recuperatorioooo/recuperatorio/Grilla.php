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

        require_once "./Patineta.php";

        $patinetas = Patineta::ObtenerPatinetasBD();

        $grilla = "<table border='1'>
                        <tbody>
                            <thead>
                                <th>Marca</th>
                                <th>Precio</th>
                                <th>Foto</th>
                            </thead>";
        
        foreach($patinetas as $item) {

            $grilla .= "<tr>
                            <td>".$item->GetMarca()."</td>
                            <td>".$item->getprecio()."</td>
                            <td><img src='./patinetasImagen/".$item->GetFoto()."' width='50px' height='50px'/></td>
                        </tr>";
        }

        $grilla .= "</tbody>
                </table>";
        echo $grilla;
    ?>
</body>
</html>