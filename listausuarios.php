<?php
    include("conexion/conexionbd.php");
        session_start();
    if(!isset($_SESSION['id_Usuario'])) 
    { 
        header("Location:index.php");
    } 
    $iduser=$_SESSION['id_Usuario'];
    $nivel=$_SESSION['tipo_usuario'];
    if($nivel!=1){
        header("Location:index.php");
    } 
    $sql="SELECT u.idUsuario, a.nombreA FROM usuarios AS u INNER JOIN alumnos AS a ON u.idAlumno=a.IdAlumno WHERE u.idUsuario='$iduser'"; 
    $resultado=$conexion->query($sql);
    $row=$resultado->fetch_assoc();
    $alumno="SELECT u.idUsuario, a.nombreA, a.correoA, u.nombreU FROM usuarios as u INNER JOIN alumnos AS a ON u.idAlumno=a.idAlumno "; 
    $resultadoalumno=$conexion->query($alumno);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <title>Administración de Usuarios</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="jumbotron.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
            <li class="nav-item">
                <a class="nav-link disabled" href="listausuarios.php">Lista de Usuarios</a>
            </li>
        <?php }?>
 </ul>

 <div class="dropdown">
 <button class="btn btn-secondary dropdown-toggle" type="button"
id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-xpanded="false">
<?php echo $row['nombreA']; ?>
			</button>
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
          <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" >
            Código:<input type="text" name="cod" placeholder="CD101" required="">
            Asignatura:<input type="text" name="nom" placeholder="Programación" required="">
            Nota:<input type="number" name="nota" placeholder="99"required="">
            <input type="submit" name="guardar" class="btn btn-primary"
            value="Guardar">
          </form>
          <hr>
          <h4 align="center">****Lista de usuarios****</h4>
          <table class="table table-hover">
          <thead>
                <tr><th>Código</th>
                <th>Asignatura</th>
                <th>Nota</th>
                <th>Editar</th>
                <th>Eliminar</th>
                </tr>
              </thead>
            <tbody>
            <?php
            while($regalumno=$resultadoalumno->fetch_array(MYSQLI_BOTH)) 
            { 
                echo 
                    "<tr>
                    <td>".$regalumno['nombreA']."</td>
                    <td>".$regalumno['nombreU']."</td>
                    <td>".$regalumno['correoA']."</td>
                    <td><a 
                    href='Editarasignatura.php?id=".$regalumno['idUsuario']."'>Editar</a></td>
                    <td><a 
                    href='Eliminarasignatura.php?id=".$regalumno['idUsuario']."'>Eliminar</a></t
                    d>
                    </tr>
                    ";}
                   $conexion->close(); 
                ?>
            </tbody>
            </table>
                </div>
                </div>
        </main>
        <footer class="container">
      <?php require_once("piedepagina.php"); ?>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>