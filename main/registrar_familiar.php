<?php

	include '../php/funciones.php';
	session_start();

	date_default_timezone_set("America/Caracas");
	$hora = date('H:i:s a');
	$fecha = date('Y-m-d');

	#var_dump($_POST);

	if ($_POST) {
		$ced_exp = isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
		$ced_fam = isset($_POST['ced_fam']) ? $_POST['ced_fam'] : '';
		$nom_fam = isset($_POST['nom_fam']) ? $_POST['nom_fam'] : '';
		$ape_fam = isset($_POST['ape_fam']) ? $_POST['ape_fam'] : '';
		$fec_fam = isset($_POST['fec_fam']) ? $_POST['fec_fam'] : '';
		$tip_par = isset($_POST['tip_par']) ? $_POST['tip_par'] : '';

		 if($ced_exp==$ced_fam){
		 	#echo"<script>alert('No puede ser carga familiar el trabajador')</script>";
		 	$_SESSION['mensaje'] = "No puede ser carga familiar el trabajador";
		 	header("location: insertar_familiar.php?ced_exp={$ced_exp}");
		 }
	     elseif (strtotime($fec_fam) > $fecha) 
	     {
	     	$_SESSION['mensaje'] = "No se puede poner un familiar no nacido";
	     	header("location: insertar_familiar.php?ced_exp={$ced_exp}");
	      
	     }else{

			registrarFamiliar($ced_exp, $ced_fam, $nom_fam, $ape_fam, $fec_fam, $tip_par);

			if(mysqli_affected_rows($conexion)>0) {
				
				$_SESSION ['mensaje'] = "Registro exitoso";

				header("location: insertar_familiar.php?ced_exp={$ced_exp}");

			}else{

				$_SESSION ['mensaje'] = "Registro no se pudo realizar";
				header("location: insertar_familiar.php?ced_exp={$ced_exp}");
			}

		}		

	}
?>