<?php
	include '../php/funciones.php';
	session_start();

	#var_dump($_POST);

	if($_POST)
		{	
			$ced_exp = isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
			$new_ced = isset($_POST['new_x2']) ? $_POST['new_x2'] : '';
			$nom_fam = isset($_POST['nom_fam']) ? $_POST['nom_fam'] : '';
			$ape_fam = isset($_POST['ape_fam']) ? $_POST['ape_fam'] : '';
			$fec_fam = isset($_POST['fec_fam']) ? $_POST['fec_fam'] : '';
			$tip_par = isset($_POST['tip_par']) ? $_POST['tip_par'] : '';
			#echo $tip_par;
			$ced_fam = isset($_POST['ced_fam']) ? $_POST['ced_fam'] : '';

			actualizarFamiliar($new_ced,$nom_fam,$ape_fam,$fec_fam,$tip_par,$ced_exp,$ced_fam);

			
								
			if(mysqli_affected_rows($conexion)>0)
			{
				
				$_SESSION ['mensaje'] = "Actualización exitosa";
				header("location: insertar_familiar.php?ced_exp={$ced_exp}");
			}
			else
			{
				$_SESSION ['mensaje'] = "Actualización no exitosa";
				header("location: insertar_familiar.php?ced_exp={$ced_exp}");
			}
			
   		}

?>