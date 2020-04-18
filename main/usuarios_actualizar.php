<?php
	include "../php/conexion.php";
	include ("../php/funciones.php");


	if ($_POST) {
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
		$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
		$status = isset($_POST['status']) ? $_POST['status'] : '';

		echo $result = actualizarUsuarios($username,$nombre,$apellido,$status);

	}

?>
