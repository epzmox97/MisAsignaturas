<?php
include("conexion/conexionbd.php");
session_start();

 if(!isset($_SESSION['id_Usuario'])){
 	header("Location:index.php");
 }

$iduser=$_SESSION['id_Usuario'];
$sql="SELECT u.idUsuario, a.nombreA FROM usuarios 
 AS u INNER JOIN alumnos AS a ON u.idAlumno=a.idAlumno WHERE u.idUsuario='$iduser'";
 $resultado=$conexion->query($sql);
 $row=$resultado->fetch_assoc();

if (!empty($_POST))
{
	$codigo=mysqli_real_escape_string($conexion,$_POST['cod']);
	$asignatura=mysqli_real_escape_string($conexion,$_POST['nom']);
	$nota=mysqli_real_escape_string($conexion,$_POST['nota']);
	$vermaterias="SELECT idasignatura, codigoasignatura, nombreasignatura, nota FROM asignaturas WHERE codigoasginatura='$codigo' AND idAlumno='$iduser'";
	$existemateria=$conexion->query($vermaterias);
	$fila= $existemateria->num_rows;
    
	if ($fila>0){
		echo "<script>
				alert ('La Asignatura existe');
				window.location='index.php';
			  </script>";

	}else{
		$sqlmateria="INSERT INTO asignaturas(codigoasignatura, nombreasignatura, nota,idAlumno) VALUES ('$codigo','$asignatura','$nota','$iduser')";
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
$materia="SELECT u.idUsuario, m.idasignatura, m.codigoasignatura,m.nombreasignatura,m.nota FROM usuarios as u INNER JOIN asignaturas
          AS m ON u.idUsuario=m.idAlumno WHERE u.idUsuario='$iduser'";
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
          <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST" >
            Código:<input type="text" name="cod" placeholder="CD101" required="">
            Asignatura:<input type="text" name="nom" placeholder="Programación" required="">
            Nota:<input type="number" name="nota" placeholder="99"required="">
            <input type="submit" name="guardar" class="btn btn-primary"
            value="Guardar">
          </form>
          <hr>
            <h4 align="center">****Mis Asignaturas****</h4>
            <table id="example" class="table table-striped table-bordered" style="width:100%">
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
                 while($regmaterias=$resultadomateria->fetch_array(MYSQLI_BOTH)) 
                { 
                  echo 
                    "<tr>
                      <td>".$regmaterias['codigoasignatura']."</td>
                      <td>".$regmaterias['nombreasignatura']."</td>
                      <td>".$regmaterias['nota']."</td>
                      <td><a href='Editarasignatura.php?id=".$regmaterias['idasignatura']."'>Editar</a></td>
                    <td><a href='Eliminarasignatura.php?id=".$regmaterias['idasignatura']."'>Eliminar</a></td>
                    </tr>";}
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