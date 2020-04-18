<?php
	include '../php/funciones.php';

		var_dump($_POST);
	
	if ($_POST) {
		 $ced_exp = isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
		 $nom_fun = isset($_POST['nom_fun']) ? $_POST['nom_fun'] : '';
		 $ape_fun = isset($_POST['ape_fun']) ? $_POST['ape_fun'] : '';
		 #$cod_rac_exp = $_POST['cod_rac_exp'];
		 $lug_nac_fun = isset($_POST['lug_nac_fun']) ? $_POST['lug_nac_fun'] : '';
		 $pai_fun = isset($_POST['pai_fun']) ? $_POST['pai_fun'] : '';
		 $fec_nac_fun = isset($_POST['fec_nac_fun']) ? $_POST['fec_nac_fun'] : '';
		 
		 $cor_fun= isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
		 $est_civ_exp = isset($_POST['est_civ_exp']) ? $_POST['est_civ_exp'] : '';
		 $dir_exp = isset($_POST['dir_exp']) ? $_POST['dir_exp'] : '';
		 $cond_exp = isset($_POST['cond_exp']) ? $_POST['cond_exp'] : '';
		 $est_fun = isset($_POST['est_fun']) ? $_POST['est_fun'] : '';
		 $ciu_exp = isset($_POST['ciu_exp']) ? $_POST['ciu_exp'] : '';
		 #$estatus_car=isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
		 #$cod_car = $_POST['cod_car'];
		 #$cod_dep = $_POST['cod_dep'];
		 #$f_ing_exp = isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
		 #$cod_area= isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
		 #$tel_exp = isset($_POST['ced_exp']) ? $_POST['ced_exp'] : '';
		 #$lib_mil_exp = $_POST['lib_mil_exp'];
		 #$pasaporte = $_POST['pasaporte'];
		 #$f_reti_exp = $_POST['f_reti_exp'];
	     #$id_exp=$ced_exp.'-'.$cod_car.'-'.$cod_dep;
	     #
	     #
	   actualizarFuncionario($ced_exp,$nom_fun,$ape_fun,$lug_nac_fun,$pai_fun,$fec_nac_fun,$cor_fun,$est_civ_exp,$dir_exp,$cond_exp,$ciu_exp,$est_fun);

	    
	     if(mysqli_affected_rows($conexion)>0)
			{
				
				$_SESSION ['mensaje'] = "Actualización exitosa";
				header("location: consulta.php?codigo={$ced_exp}");
			}
			else
			{
				$_SESSION ['mensaje'] = "Actualización no exitosa";
				header("location: consulta.php?codigo={$ced_exp}");
			}
			
	}
	

?>