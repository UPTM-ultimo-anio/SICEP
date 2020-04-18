<?php 
	 session_start();
	 include '../php/conexion.php';
	 include '../php/funciones.php';

 	$ced_exp=$_GET['codigo'];
 	$ced_fam=$_GET['ced_fam'];
 	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    $mensaje = $_SESSION['mensaje'];

    $result=mostrarActualizarFamiliar($ced_exp,$ced_fam);
	
	$fila=$result->fetch_assoc();

    if(isset($_POST['regresar'])){
			#echo "<script>window.location='consulta.php?codigo=".$ced_exp."'</script>";
			header("location: insertar_familiar.php?ced_exp={$ced_exp}");
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<title>Actualizar Familiar</title>
	
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

	
</head>
<body>

	<? include("menu.php"); ?>

	  <form name="actualizar" action="actualizar_familiar.php" method="post" id="formulario">
  
  
		<div class="form-group col-sm-3 container">
		<input type="hidden" name="ced_exp" value="<?php echo $ced_exp ?>">
		<input type="hidden" name="ced_fam" value="<?php echo $ced_fam ?>">
		<label tex-aling for="ced_fam"><strong  >Cédula del familiar:</strong></label>
		 <input type="text" name="new_x2" class="form-control" id="ced_fam" value= "<?PHP echo $ced_fam; ?>" />
		 </div>

		<div class="form-group col-sm-3 container">
		    <label for="nom_fam"><strong>Nombre del familiar:</strong></label>
		    <input type="text" name="nom_fam" class="form-control" id="nom_fam"  value= "<?PHP echo $fila['nom_fam']; ?>" />
		</div>

		<div class="form-group col-sm-3 container">
		 <label for="ape_fam"><strong>Apellido del familiar:</strong></label><td>
		<input type="text" name="ape_fam" class="form-control" id="ape_fam"   value= "<?PHP echo $fila['ape_fam']; ?>"/>
		</div>
		<div class="form-group col-sm-3 container">
		  <label for="fec_fam"><strong>Fecha de nacimiento:</strong></label>
		<input name="fec_fam" type="text" class="form-control" id="fec_fam"  value="<?PHP echo $fila['fec_fam']; ?>" size="10"/>
		</div>
		    
		    
			<?php 
						$result = mostrarParentesco();
		 				
						echo '<div class="form-group col-sm-3 container"><strong>Parentesco: </strong>';
		                    echo '<select class="custom-select custom-select-md mb-3" name="tip_par">';
		                    echo '<option value="">Parentesco</option>';
							 while($parentesco = mysqli_fetch_array($result)){
							 echo '<option value="' . $parentesco["tip_par"] . '"';
		                            if ($parentesco["tip_par"] == $fila["tip_par"])
		                                echo ' selected';
		                            echo '>'.$parentesco['nom_par'].'</option>';
		                    }
		                    echo '</select></div>'; ?>		  
		 <div class="row">

		 <div class="col-sm-5"></div>

		 <div class="form-group col-sm-3 container">
		    <input class="btn btn-primary" name="boton" id="boton" type="submit" value="Modificar" />

		  </div>
		    

		</form>

		 <div class="form-group col-sm-3 container">
		   <form method="post">
					<input type="submit" name="regresar" id="regresar" class="btn btn-secondary" value="Regresar">
			</form>		

		  </div>

		</div>




	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>