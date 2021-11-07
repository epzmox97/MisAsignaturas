<?php
include("conexion/conexionbd.php");
	session_start();
	if(!isset($_SESSION['id_Usuario'])) 
 	{ 
 	header("Location:index.php");
 	} 
$iduser=$_SESSION['id_Usuario'];
$sql="SELECT u.idUsuario, a.nombreA FROM usuarios AS u INNER JOIN alumnos AS a ON u.idAlumno=a.IdAlumno WHERE u.idUsuario='$iduser'"; 
$resultado=$conexion->query($sql);
$row=$resultado->fetch_assoc();
$id=$_GET['id'];
$materias="SELECT idasignatura,codigoasignatura,nombreasignatura,nota FROM asignaturas WHERE idasignatura='$id'";
$resultadomaterias=$conexion->query($materias);
$filas=$resultadomaterias->fetch_assoc();
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Administración de usuarios</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/jumbotron/">

    <link href="css/bootstrap.min.css" rel="stylesheet">

    <link href="jumbotron.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
        <?php require_once("menusuperior.php"); ?>
        <?php 
          if($_SESSION['tipo_usuario']==1)
          {?>
            <li class="nav.item">
              <a class="nav-link disabled" href="listausuarios.php">Lista de usuarios</a>
            </li>              
        <?php  }?>  
        </ul>
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
	<h3 align="center">Modificar Asignaturas</h3>
	<form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" >
				Código:<input type="text" name="cod" value="<?php echo $filas['codigoasignatura'];?>" >	
				Asignatura:<input type="text" name="nom" value="<?php echo $filas['nombreasignatura'];?>" >
				Nota:<input type="number" name="nota" value="<?php echo $filas['nota'];?>"  >
				<input type="hidden" name="ID" value="<?php echo $id;?>"  >
				<input type="submit" name="editar" value="Modificar">
	</form>

	<?php
		if (isset($_POST['editar']))
		{
			$cod=$_POST['cod'];
			$materia=$_POST['nom'];
			$nota=$_POST['nota'];
			$id=$_POST['ID'];
			$sqlModificar="UPDATE asignaturas SET codigoaasignatura='$cod',nombreasignatura='$materia',nota='$nota' WHERE idasignatura='$id'";
			$modificado=$conexion->query($sqlModificar);
			
			if($modificado>0){
					echo "<script>
						alert('El Registro fue exitoso');
						window.location='index.php';
					  </script>";
				}else
					{
						echo "<script>
							alert('Error en el registro');
							window.location='Editarasginatura.php';
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

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>