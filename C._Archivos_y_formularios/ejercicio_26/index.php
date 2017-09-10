<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 26</title>
</head>
<body>
    <form action="./admin.php" method="post">
        <select name="slcBase">
            <optgroup label="Base">
                <?php

                    for($i=1 ; $i<51 ; $i++){

                        echo "<option>".$i."</option>";
                    }
                ?>
            </optgroup>
        </select>
        <select name="slcAltura">
            <optgroup label="Altura">
                <?php

                    for($i=1 ; $i<51 ; $i++){

                        echo "<option>".$i."</option>";
                    }
                ?>
            </optgroup>
        </select>
        <input type="submit" value="Generar tabla" />
    </form>
</body>
</html>