<?php
    include("conexion/conexionbd.php");
    session_start();



    if(!isset($_SESSION['id_Usuario']))
    {
        header("location:index.php");
    }
    $iduser=$_SESSION['id_Usuario'];