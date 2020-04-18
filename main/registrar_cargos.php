<?php

	include '../php/funciones.php';
	session_start();

	date_default_timezone_set("America/Caracas");
	$hora = date('H:i:s a');
	$fecha = date('Y-m-d');

	var_dump($_POST);


?>