<?php

	session_start();

	include '../php/conexion.php';
	include '../php/funciones.php'; 
	#var_dump($_POST);

	if ($_POST) {
		$username = isset($_POST['username']) ? $_POST['username'] : '';
		$status = isset($_POST['status']) ? $_POST['status'] : '';
		$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
		$apellido = isset($_POST['apellido']) ? $_POST['apellido'] : '';
		$password = isset($_POST['password']) ? $_POST['password'] : '';
		$password2 = isset($_POST['password2']) ? $_POST['password2'] : '';
		$id_tipo = isset($_POST['id_tipo']) ? $_POST['id_tipo'] : '';

		if (usuarioRepetido($username) > 0) {
			$_SESSION['mensaje'] = "Este usuario ya existe";
			header("location: register_user.php");
		}
		elseif ($password != $password2) {
			$_SESSION['mensaje'] = "La contraseña y confirmar contraseña deben ser iguales";
			header("location: register_user.php");
		}
		else{
			$result = registrarUsuario($username,$nombre,$apellido,$password,$id_tipo,$status);

			if ($result > 0) {
				$_SESSION['mensaje'] = "Registro el usuario satifactoriamente";
				header("location: register_user.php");
			}
			else {
				$_SESSION['mensaje'] = "Error al registrar el usuario";	
				header("location: register_user.php");
			}			
		}
	}

?>