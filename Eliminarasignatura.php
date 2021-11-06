<?php
include("conexion/conexionbd.php");
$id=$_GET['id'];
$EliminarAsignatura="DELETE FROM asignaturas WHERE idasignatura='$id'";
$resultado=$conexion->query($EliminarAsignatura);
echo "<script>
		alert('Registro Eliminado');
		window.location='index.php';
	  </script>";
$conexion->close();
?>
	