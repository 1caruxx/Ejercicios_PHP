<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 26</title>
</head>
<body bgcolor=<?php echo $_REQUEST["slcOpcion"]; ?>>
    <form>
         <select name="slcOpcion">
            <optgroup label="Colores">
                <option value="#ff4000">Rojo</option>
                <option value="#ffff00">Amarillo</option>
                <option value="#00ff00">Verde</option>
                <option value="#0000ff">Azul</option>
                <option value="#ff00bf">Rosa</option>
            </optgroup>
         </select>
        <input type="submit" value="Cambiar color" />
    </form>
</body>
</html>