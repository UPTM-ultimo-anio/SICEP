<?php 
	session_start();
	include ('../php/funciones.php');
	include ('../php/conexion.php');

	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	$fecha = strtotime(date("Y-m-d"));

	registrarBitacora($usuario,$enlace_actual);

	$result = mostrarUsuario($usuario);
	$row = $result->fetch_assoc();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Perfil del usuario</title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php  include("menu.php");?>

<br>


	<div class="container text-center">
		<h3 class="">Mi Perfil</h3>
		<br>

<table class="table table-hover">
		<thead>
			<th><strong>Nombre de Usuario:</strong>
		<? echo $row['nombre']; ?></th>


    <th><strong>Apellido: </strong> <? echo $row['apellido'] ?> </th>

    <th><strong>Tipo de Usuario:</strong>
		<?if ($row['id_tipo']=='1') {
			echo "Soy Administrador";

		}else echo "Soy Secretario"; ?></th>

	</div>
</thead>
	</table>
	

	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>

</body>
</html>