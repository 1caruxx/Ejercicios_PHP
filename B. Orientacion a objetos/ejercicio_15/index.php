

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?php
        include_once "clases/Rectangulo.php";

        $miRectangulo = new Rectangulo(3, 2);

        $miRectangulo->SetColor("Red");

        echo "p style='color:{$miRectangulo->GetColor()}'>";
    ?>
    
</body>
</html>