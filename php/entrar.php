<?php 
	include 'funciones.php';
	session_start();

	date_default_timezone_set("America/Caracas");
	$hora = date('H:i:s a');
	$fecha = date('Y-m-d');

	if ($_POST) {
		$usuario = isset($_POST['usuario']) ? $_POST['usuario'] : '';
		$password = md5(isset($_POST['password']) ? $_POST['password'] : '');

		$result = iniciarSesion($usuario, $password);

		$row = $result->fetch_assoc();

		if ($row > 0) {
			$_SESSION ['usuario']= $row ['username'];
		    $_SESSION ['tipo_usua'] =$row['id_tipo'];


			header("location: ../main/inicio.php");

		}else{

			$_SESSION ['mensaje'] = 1;
			header("location: ../index.php");
		}

	}

	


?>