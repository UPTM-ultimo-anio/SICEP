<?php 
 
include("../../conexion.php");
 session_start();


 date_default_timezone_set("America/Caracas"); 
 $hora = date('H:i:s a');
 $fecha = date('Y-m-d');

 // $sql = "UPDATE bitacora SET fecha_salida = '".$fecha."',hora_salida='".$hora."' WHERE username = '".$_SESSION['id_cedu']."'";
 // mysqli_query($conexion,$sql);

 session_unset();
 session_destroy();
 header("location:../index.php");
 ?>
 