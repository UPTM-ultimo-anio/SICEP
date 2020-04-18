<?php 
	session_start();
	include '../php/conexion.php';
	include '../php/funciones.php';

	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    if(isset($_POST['boton'])){
		$ced_fun = isset($_POST['ced_fun']) ? $_POST['ced_fun'] : '';
		$result = buscarSoliFuncionario($ced_fun);
		//header("location: solicitar_vacaciones.php");
	}

	if (isset($_POST['imprimir'])) {
		$ced_fun = isset($_POST['ced_fun']) ? $_POST['ced_fun'] : '';
		$fec_sol_vac = date('d/m/Y-H:i:s');
		$per_vac = isset($_POST['per_vac']) ? $_POST['per_vac'] : '';
		$tip_vac = isset($_POST['tip_vac']) ? $_POST['tip_vac'] : '';
		$fec_ini_vac = isset($_POST['fec_ini_vac']) ? $_POST['fec_ini_vac'] : '';
		$fec_fin_vac = isset($_POST['fec_fin_vac']) ? $_POST['fec_fin_vac'] : '';
			#echo $tip_par;
			#
		if (strtotime($fec_ini_vac)>strtotime($fec_fin_vac)) {
			echo "<script>alert('La fecha hasta tiene que ser mayor a la fecha desde')</script>";
		}
		elseif (DiferenciaDeDia($fec_ini_vac,$fec_fin_vac)>15) {
		 	echo "<script>alert('El maximo de dias tiene que ser de 15 dias')</script>";
		}
		 elseif (TiempoTrabajando($ced_fun)<1) {
			echo "<script>alert('El trabajador debe haber trabajado mas de un año')</script>";
		}
		else{
			$result = solicitarVacaciones($ced_fun,$fec_sol_vac,$per_vac,$tip_vac,$fec_ini_vac,$fec_fin_vac);

			if (mysqli_affected_rows($conexion)>0) {
				echo "<script>alert('Se inserto el registro con exito pulsa aceptar para continuar')</script>";
				echo "<script>nuevaVentana= window.open('soli_vacaciones.php?fec_sol_vac=".$fec_sol_vac."')</script>";
			}else{
					echo "<script>alert('Error: No se pudo hacer su solicitud por que ya fue solicitada anteriormente')</script>";
				}	
		}
	}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Solicitud de Vacaciones</title>

	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>

<div class="container">
	<h3 class="text-center">Solicitar Vacaciones</h3>
		<form method="post" action="">
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="buscar">Ingrese la cédula</label>
					<input type="text" name="ced_fun" id="ced_fun" class="form-control" value=<?php if (isset($ced_fun)){ 
						echo $ced_fun;
						} else{
						echo $_GET['ced_fun'];
						}
					?>>
				</div>
				<div class="form-group col-sm-6">
					<label></label>
					<button type="submit" name="boton" class="btn btn-success btn-sm btn-block" value="buscar" >Buscar</button>
				</div>
			</div>
		</form>

		<?php 
			if ($result->num_rows>0) {
				while ($datos = $result->fetch_assoc()) {
		?>

			<form class="form" method="post">
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="ced_fun">Cédula</label>
					<input type="text" class="form-control" name="ced_fun" id="ced_fun" value="<?php echo $datos['ced_fun']; ?>" disabled>
					<input type="hidden" name="ced_fun" cols="888" id="ced_exp" value="<?php echo $datos['ced_fun']; ?>" />
				</div>
				<div class="form-group col-sm-6">
					<label for="ced_fun">Nombre</label>
					<input type="text" class="form-control" name="nom_fun" value="<?php echo $datos['nom_fun']; ?>" disabled>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="ced_fun">Apellido</label>
					<input type="text" class="form-control" name="ape_fun" value="<?php echo $datos['ape_fun']; ?>" disabled>
				</div>
				<div class="form-group col-sm-6">
					<label for="ced_fun">Fecha de ingreso</label>
					<input type="text" class="form-control" name="fec_ing_fun" value="<?php echo date('d-m-Y',strtotime($datos['fec_ing_exp'])); ?>" disabled>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="nom_car">Cargo</label>
					<input type="text" class="form-control" name="nom_car" value="<?php echo $datos['nom_car']; ?>" disabled>
				</div>
				<div class="form-group col-sm-6">
					<label for="nom_dep">Fecha de ingreso</label>
					<input type="text" class="form-control" name="nom_dep" value="<?php echo $datos['nom_dep']; ?>" disabled>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="per_vac">Periodo</label>
					<input type="text" id="per_vac" name="per_vac" class="form-control" required>
				</div>
				<div class="form-group col-sm-6">
					<label for="tip_vac">Tipo de Vacaciones</label>
					<select name="tip_vac" id="tip_vac" class="custom-select custom-select-md mb-3" required>
						<option value="">Seleccione</option>
						<option value="REGLAMENTARIA">REGLAMENTARIA</option>
						<option value="RETRASADA">RETRASADA</option>
					</select>
				</div>
				<div class="form-group col-sm-6">
					<label for="fec_ini_vac">Desde</label>
					<input type="date" name="fec_ini_vac" id="fec_ini_vac" class="form-control" required>
				</div>
				<div class="form-group col-sm-6">
					<label for="fec_ini_vac">Hasta</label>
					<input type="date" name="fec_fin_vac" id="fec_fin_vac" class="form-control" required>
				</div>
				
			</div>
			<div class="form-row">
				<div class="col-5"></div>
				<div class="form-group col-sm-4">
					<button type="submit" name="imprimir" class="btn btn-success btn-sm btn-block" >Guardar e Imprimir</button>
				</div>
			</div>
		</form>

		<?php 
				}
			}

		?>


</div>



	

	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>	
</body>
</html>