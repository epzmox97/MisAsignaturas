<?php
    include("conexion/conexionbd.php");
    session_start();

    if(!isset($_SESSION['id_Usuario'])) 
        { 
        header("Location:index.php");
        } 
        $iduser=$_SESSION['id_Usuario'];
        $sql="SELECT u.idUsuario, u.nombreU,u.passwordU,a.idAlumno,a.nombreA,a.telefonoA,a.generoA,a.correoA 
                    FROM usuarios AS u INNER JOIN alumnos AS a ON u.idAlumno=a.IdAlumno WHERE u.idUsuario='$iduser'"; 
        $resultado=$conexion->query($sql);
        $row=$resultado->fetch_assoc();
    ?>
    <!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content=""><meta name="author" content=""><link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
            <title>Perfil de Usuario</title>
            <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">
            <link href="css/bootstrap.min.css" rel="stylesheet"><link href="jumbotron.css" rel="stylesheet">
        </head>
            <body>
            <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
            <?php require_once("menusuperior.php"); ?>
            <?php 
                if($_SESSION['tipo_usuario']==1) 
                { 
            ?>
            <li class="nav-item"><a class="nav-link disabled" href="listausuarios.php">Lista de Usuarios</a></li>
            <?php 
                }
            ?>
            </ul>
            <div class="dropdown"><button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo utf8_decode($row['nombreA']); ?></button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="perfil.php">Perfil</a>
                    <a class="dropdown-item" href="salir.php">Cerrar</a>
                </div>
            </div>
            </div>
                </nav>
                <main role="main">
                    <div class="jumbotron">
                    <div class="container">
                    <hr>
                    <h4 align="center">****Perfil de Usuario****</h4>
     <form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
                            <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputNombreA">Nombre del Alumno</label>
                            <input type="text" class="form-control" id="inputNombreA" name="nombrealumno" value="<?php echo $row['nombreA'];?>"> 
                  </div>
                <div class="form-group col-md-6">
                    <label for="inputPUser">Usuario</label>
                    <input type="text" class="form-control" id="inputUser" name="user" value="<?php echo $row['nombreU'];?>">
                </div>
            </div>
                <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputTelefono">Teléfono</label>
                <input type="tel" class="form-control" id="inputTelefono" name="telefono" value="<?php echo $row['telefonoA'];?>">
            </div>
                <div class="form-group col-md-6">
                <label for="exampleFormControlSelect1">Genero</label>
                <select class="form-control" id="exampleFormControlSelect1" name="genero">
                    <option <?php echo $row['generoA']==='Masculino' ? "selected='selected'":""?>value="Masculino">Masculino</option>
                    <option <?php echo $row['generoA']==='Femenino' ? "selected='selected'":""?>value="Femenino">Femenino</option>
                </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" id="inputEmail4" name="email" value="<?php echo $row['correoA'];?>"> 
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword4">Password</label>
                <input type="password" class="form-control" id="inputPassword4" name="pass">
            </div>
        </div>
            <input type="hidden" name="ID" value="<?php echo $iduser;?>">
                <button type="submit" class="btn btn-primary" name="editar">Actualizar</button>
    </form>
            <?php
            if (isset($_POST['editar']))
            { 
                $nombrealumno=$_POST['nombrealumno'];
                $user=$_POST['user'];
                $telefono=$_POST['telefono'];
                $genero=$_POST['genero'];
                $email=$_POST['email'];
                $id=$_POST['ID'];
                   if($_POST['pass']==""){
                $password=$row['passwordU'];
                    }else{ 
                $password=sha1($_POST['pass']);
                    } 
                $sqlModificar="UPDATE usuarios AS u INNER JOIN alumnos AS a ON (u.idAlumno=a.IdAlumno)SET
            u.nombreU='$user', u.passwordU='$password', a.nombreA='$nombrealumno',a.telefonoA='$telefono',a.generoA='$genero',a.correoA='$email' WHERE u.idUsuario='$id'"; 
                $modificado=$conexion->query($sqlModificar);
            
                if($modificado>0){
                    echo "<script>
                    alert('Registro modificado');
                    window.location='perfil.php';
                    </script>"; 
                 }else
                    {    
                    echo "<script>
                    alert('Error al modificar');
                    window.location='perfil.php';
                    </script>"; 
                    } 
            } 
                $conexion->close();
            ?>
            </div>
            </div>
            </main>
            <footer class="container">
                <?php require_once("piedepagina.php"); ?>
            </footer>

        <script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
        <script src="../../assets/js/vendor/popper.min.js"></script><script src="js/bootstrap.min.js"></script>
 </body>
</html