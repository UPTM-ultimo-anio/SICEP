<?php 
	 session_start();
	 include '../php/conexion.php';
	 include '../php/funciones.php';

 	$ced_exp=$_GET['codigo'];
 	$fec_car_ing=$_GET['fec_car_ing'];
 	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    $mensaje = $_SESSION['mensaje'];

    $result=mostrarCargosFuncionario($ced_exp,$fec_car_ing);
	
	$fila=$result->fetch_assoc();

    if(isset($_POST['regresar'])){
			#echo "<script>window.location='consulta.php?codigo=".$ced_exp."'</script>";
			header("location: cargos.php?ced_exp={$ced_exp}");
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<title>Actualizar Cargos</title>
	
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

	
</head>
<body>

	<? include("menu.php"); ?>

	  <form name="actualizar" action="actualizar_cargos.php" method="post" id="formulario">
  
  
		<div class="form-group col-sm-3 container">
		<input type="hidden" name="ced_exp" value="<?php echo $ced_exp ?>">
		<input type="hidden" name="fec_car_ing" value="<?php echo $fec_car_ing ?>">
			<label for="cod_car"><strong>Cargo</strong></label>
			<select name="cod_car" id="cod_car" class="custom-select custom-select-md mb-3">
				<?php 
					$result = mostrarCargos();
					while($cargo = mysqli_fetch_array($result)){

				?>
				<option value="<?php echo $cargo['cod_car']; ?>" 
				<?php if ($cargo['cod_car'] == $fila['cod_car']) {
					echo "selected";
				} ?> >
				 <?php echo $cargo['nom_car']; ?>
				 	
				 </option>

				<?php } ?>
			</select>
		 </div>

		<div class="form-group col-sm-3 container">
			<label for="cod_dep"><strong>Departamento</strong></label>
			<select name="cod_dep" id="cod_dep" class="custom-select custom-select-md mb-3">
				<?php 
					$result = mostrarDepartamento();
					while($departamento = mysqli_fetch_array($result)){

				?>
				<option value="<?php echo $cargo['cod_dep']; ?>" 
				<?php if ($departamento['cod_dep'] == $fila['cod_dep']) {
					echo "selected";
				} ?> >
				 <?php echo $departamento['nom_dep']; ?>
				 	
				 </option>

				<?php } ?>
			</select>
		 </div>
		</div>

		<div class="form-group col-sm-3 container">
		<label for="fec_car_ing"><strong>Fecha de Ingreso al Cargo:</strong></label>
		 <input type="date" name="new_x2" class="form-control" id="fec_car_ing" value= "<?PHP echo $fec_car_ing; ?>" />
		</div>
		<div class="form-group col-sm-3 container">
		  <label for="fec_fam"><strong>Fecha de Retiro al Cargo:</strong></label>
		<input name="fec_ret_car" type="date" class="form-control" id="fec_ret_car"  value="<?PHP echo $fila['fec_ret_car']; ?>" size="10"/>
		</div>
		<div class="form-group col-sm-3 container">
			<label for="est_car">Tipo de Trabajador</label>
			<select name="est_car" id="est_car" class="custom-select custom-select-md mb-3">
				<option <?php if(strcmp($fila['est_car'], 'contratado')==0){ echo "selected "; } ?>VALUE="contratado">Contratado</option>
				<option <?php if(strcmp($fila['est_car'], 'fijo')==0){ echo "selected "; } ?>VALUE="fijo">Fijo</option>
			</select>
		</div>

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