<?php 
include("conexion/configuracion.php"); 
//$conexion=mysqli_connect($server,$user,$pass) or die ("Error selección de servidor, usuario o contraseña");
//$bd=mysqli_select_db($conexion,"misasignaturas")or die ("Error selección de base de conexión y base de datos");

$conexion=new mysqli($server,$user,$pass,$bd);
	if (mysqli_connect_errno()){
		echo "No Conectado",mysql_connect_error();
	}else{
		//echo "Conectado a la BD";
	}
?>