<?php
include("conexion/conexionbd.php");
$id=$_GET['id'];
$materias="SELECT idasignatura,codigoasignatura,nombreasignatura,nota FROM asignaturas WHERE idasignatura='$id'";
$resultadomaterias=$conexion->query($materias);
$filas=$resultadomaterias->fetch_assoc();
?>
<!DOCTYPE html>
	<html lang="en">
	 <!––  dfdf--->
	<head>
		<meta charset="utf-8">
		<title></title>
	</head>
	<body>
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
	</body>
	</html>	