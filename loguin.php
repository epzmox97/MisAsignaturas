<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST"> 
    <input type="text" name="user" placeholder="Nombre Usuario">
    <input type="password" name="pass" placeholder="Password">
    <input type="submit" name="ingresar" value="Ingresar">
    <br><a href="registrousuario.php">Crear Cuenta</a>

    </form>
    
</body>
</html>