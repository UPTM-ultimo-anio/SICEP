<?php 
	session_start();
	#var_dump($_POST);
	include '../php/funciones.php';

	if($_POST){
		$ced_fun = isset($_POST['ced_fun']) ? $_POST['ced_fun'] : '';


		$_SESSION['funcionario_solicitando'] = buscarSoliFuncionario($ced_fun);


		header("location: solicitar_vacaciones.php");
	}



?>