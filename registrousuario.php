<?php 
    include("conexion/conexionbd.php");
    $sql="SELECT idTipousuario, tipoUsuario FROM tipo_usuarios";
    $resultado=$conexion->query($sql);
    if(!empty($_POST)){

      $nombre=mysqli_real_escape_string($conexion,$_POST['nombrealumno']);
      $usuario=mysqli_real_escape_string($conexion,$_POST['user']);
      $genero=$_POST['genero'];
      $tipouser=$_POST['tipo_user'];
      $tel=mysqli_real_escape_string($conexion,$_POST['telefono']);
      $correo=mysqli_real_escape_string($conexion,$_POST['email']);
      $password=mysqli_real_escape_string($conexion,$_POST['pass']);
      $password_encriptada=sha1($password);
      $sqluser="SELECT idUsuario FROM usuarios WHERE nombreU='$usuario'";
      $resultadouser=$conexion->query($sqluser);
      $filas=$resultadouser->num_rows;
      if($filas>0){
        echo "<script>
        alert('Usuario ya existe');
        window.location='registrousuario.php';
        </script>";
      }else{
        $sqlalumnos="INSERT INTO alumnos(nombreA,TelefonoA,generoA, correoA) 
                      VALUES ('$nombre','$tel','$genero','$correo')";
          $resultaoalumno=$conexion->query($sqlalumnos);
        $idalumno=$conexion->insert_id;

        $sqlusuarios="INSERT INTO usuarios(nombreU,passwordU,idAlumno,idTipousuario)
                    VALUES ('$usuario','$password_encriptada','$idalumno','$tipouser')";
        $resultadousuario=$conexion->query($sqlusuarios);
        if($resultadousuario>0){
          echo "<script>
          alert('Usuario registrado');
          window.location='index.php';
          </script>";
        }else{
          echo "<script>
          alert('error al registrar el usuario');
          window.location='registrousuario.php';
          </script>";
        }
      };


    }
    
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Registro de Usuario</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        <?php require_once("menusuperior.php"); ?>
        </ul>
      </div>
    </nav>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          <h1 class="display-3">Crear Cuenta</h1>
         <form action="<?php $_SERVER["PHP_SELF"];?>" method="POST">
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputNombreA">Nombre del Alumno</label>
                <input type="text" class="form-control" id="inputNombreA" placeholder="Nombre Completo" name="nombrealumno">
                </div>
                <div class="form-group col-md-6">
                <label for="inputPUser">Usuario</label>
                <input type="text" class="form-control" id="inputUser" placeholder="User" name="user">
                </div>
            </div>
            <div class="form-row">
            <label for="TipoUset">Tipo Usuario</label>
            <select class="form-control" id="tipo_user" name="tipo_user">
            <option selected>selecione...</option>
              <?php
              while($fila=$resultado->fetch_assoc()){?>          
              <option value="<?php echo $fila['idTipousuario']; ?>"><?php echo $fila['tipoUsuario']; ?></option>
              <?php } ?>
            </select>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputTelefono">Teléfono</label>
                <input type="tel" class="form-control" id="inputTelefono" placeholder="Teléfono" name="telefono">
                </div>
                <div class="form-group col-md-6">
                  <label for="exampleFormControlSelect1">Genero</label>
                    <select class="form-control" id="exampleFormControlSelect1" name="genero">
                    <option selected>selecione...</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="inputEmail4">Email</label>
                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email" name="email">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="inputPassword4">Password</label>
                    <input type="text" class="form-control" id="inputPassword4" placeholder="Password" name="pass">
                    </div>
            </div>
            <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
            </form>
        </div>
      </div>


    </main>

    <footer class="container">
      <?php require_once("piedepagina.php"); ?>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>