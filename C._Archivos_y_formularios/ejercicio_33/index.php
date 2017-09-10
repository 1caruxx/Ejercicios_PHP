<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ejercicio 33</title>
</head>
<body>
    <form action="./admin.php">
        <input type="text" name="txtNombre" placeholder="Nombre" required/><br/><br/>
        <input type="text" name="txtApellido" placeholder="Apellido" required/><br/><br/>
        <input type="number" name="nmbEdad" placeholder="Edad" min="18" max="100" required/><br/><br/>
        <input type="text" name="txtDireccion" placeholder="Direccion" required/><br/><br/>
        <input type="email" name="emlMail" placeholder="Correo electronico" required/><br/><br/>
        <textarea name="txaCurriculum" placeholder="Curriculum Vitae" cols="30" rows="10" required></textarea><br/><br/>
        <input type="submit" value="Enviar"/>
    </form>
</body>
</html>