<?php
include("conexion/conexionbd.php");
session_start();

 if(!isset($_SESSION['id_Usuario'])){
 	header("Location:index.php");
 }

$iduser=$_SESSION['id_Usuario'];
$sql="SELECT u.idUsuario, a.nombreA FROM usuarios 
 AS u INNER JOIN alumnos AS a ON u.idAlumno=a.idAlumno 
 WHERE u.idUsuario='$iduser'";
 $resultado=$conexion->query($sql);
 $row=$resultado->fetch_assoc();

if (!empty($_POST))
{
	$codigo=mysqli_real_escape_string($conexion,$_POST['cod']);
	$asignatura=mysqli_real_escape_string($conexion,$_POST['nom']);
	$nota=mysqli_real_escape_string($conexion,$_POST['nota']);
	$vermaterias="SELECT idasignatura, codigoasignatura, nombreasignatura, nota FROM asignaturas WHERE codigoasginatura='$codigo' OR nombreasignatura='$asignatura'";
	$existemateria=$conexion->query($vermaterias);
	$fila= $existemateria->num_rows;
    
	if ($fila>0){
		echo "<script>
				alert ('La Asignatura existe');
				window.location='index.php';
			  </script>";

	}else{
		$sqlmateria="INSERT INTO asignaturas(codigoasignatura, nombreasignatura, nota) VALUES ('$codigo','$asignatura','$nota')";
		$resultadomateria=$conexion->query($sqlmateria);
		
		if($resultadomateria>0){
			echo "<script>
				alert ('El Registro fue exitoso');
				window.location='index.php';
			  </script>";
		}else
		{
			echo "<script>
				alert ('Error en el registro');
				window.location='index.php';
			  </script>";
		}
	}
}
$materia="SELECT idasignatura,codigoasignatura,nombreasignatura,nota FROM asignaturas";
$resultadomateria=$conexion->query($materia);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Sistema de Matricula - Administración de Usuarios</title>

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
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $row['nombreA']; ?>
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				<a class="dropdown-item" href="#">Perfil</a>
				<a class="dropdown-item" href="#">Cerrar</a>
			</div>
		</div>
      </div>
    </nav>

    <main role="main">

      <!-- Main jumbotron for a primary marketing message or call to action -->
      <div class="jumbotron">
        <div class="container">
          
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