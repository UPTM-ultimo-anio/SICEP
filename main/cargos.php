<?php 	
	session_start();
	 include '../php/conexion.php';
	 include '../php/funciones.php';

 	$ced_exp=$_GET['ced_exp'];
 	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);




    $mensaje = $_SESSION['mensaje'];



    if(isset($_POST['regresar'])){
			#echo "<script>window.location='consulta.php?codigo=".$ced_exp."'</script>";
			header("location: consulta.php?codigo={$ced_exp}");
	}

?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../css/main.css">
      
	<title>Cargos del Funcionario</title>


</head>
<body>

	<?php include 'menu.php'; ?>

	<div class="container">
		<div class="table-responsive">
			<table class="table">
				<thead class="thead-dark bg-primary">
					<tr>
						<th scope="col">Cargo</th>
						<th scope="col">Departamento</th>
						<th scope="col">Fecha de Ingreso</th>
						<th scope="col">Fecha de Retiro</th>
						<th scope="col">Estatus del Cargo</th>
						<th scope="col" colspan="2">Herramientas</th>
					</tr>
				</thead>
				<tbody>
						<?php 	
							$result = mostrarExpediente($ced_exp);

							while ($expediente = $result->fetch_assoc()) {
								# code...
							
						?>
					<tr>
						<td><?php echo $expediente['nom_car']; ?></td>
						<td><?php echo $expediente['nom_dep']; ?></td>
						<td><?php echo date('d-m-Y', strtotime($expediente['fec_car_ing'])); ?></td>
						<td><?php if ($expediente['fec_ret_car']== '0000-00-00'){echo 'Esta Activo';}
							else {echo date('d-m-Y', strtotime($expediente['fec_ret_car'])); }?></td>
						<td><?php echo $expediente['est_car']; ?></td>
						<td><a href=act_car_2.php?codigo=<?php echo $expediente['ced_fun'].'&fec_car_ing='.$expediente['fec_car_ing']; ?>><img src="../img/editar.png" width="25" alt="Edicion"></a></td>
						<td><a  href=eli_car.php?codigo=<?php  echo $expediente['fec_car_ing'].'&fec_car_ing='.$expediente['fec_car_ing']; ?>><img src="../img/eliminar.png" width="25" alt="Edicion" onclick='return Confirmation()' ></a></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<div>
			<h3 class="bg-primary text-center pad-basic no-btm">Agregar Nuevo Cargo</h3>
			<form action="registrar_cargos.php" class="bg-light" method="post">
				<input type="hidden" name="ced_exp" id="ced_exp" value="<?php echo $ced_exp; ?>">
				<div class="form-row">
					<div class="form-group col-lg-3 col-md-6">
						<label for="cod_car">Cargo</label>
						<select class="custom-select custom-select-md mb-3" name="cod_car" id="cod_car">
							<?php
								$result = mostrarCargos();
								while ($cargo = $result->fetch_assoc()) {
							?>
								<option value="<?php echo $cargo['cod_car']; ?>"><?php echo $cargo['nom_car']; ?></option>					
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group col-lg-3 col-md-6">
						<label for="cod_dep">Departamento</label>
						<select class="custom-select custom-select-md mb-3" name="cod_dep" id="cod_dep" >
							<?php
								$result = mostrarDepartamento();
								while ($departamento = $result->fetch_assoc()) {
							?>
								<option value="<?php echo $departamento['cod_dep']; ?>"><?php echo $departamento['nom_dep']; ?></option>					
							<?php
								}
							?>
						</select>
					</div>
					<div class="form-group col-lg-2 col-md-6">
						<label for="fec_car_ing">Fecha de Ingreso</label>
						<input type="date" class="form-control" name="fec_car_ing" id="fec_car_ing">
					</div>
					<div class="form-group col-lg-2 col-md-6">
						<label for="fec_ret_car">Fecha de Retiro</label>
						<input type="date" class="form-control" name="fec_ret_car" id="fec_ret_car">
					</div>
					<div class="form-group col-lg-2 col-md-6">
						<label for="est_car">Estatus del Cargo</label>
						<select name="est_car" id="est_car" class="custom-select custom-select-md mb-3">
							<option value="">Seleccione</option>
							<option value="contratado">Contratado</option>
							<option value="fijo">Fijo</option>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-lg-4">	
						<input type="submit" name="insertar" class="btn btn-primary" value="Agregar">
					</div>

				</div>
			</form>
				<div class="form-group col-lg-8"></div>
				<div class="form-group col-lg-4">
					<form method="post">
						<input type="submit" name="regresar" id="regresar" class="btn btn-secondary" value="Regresar">
					</form>	
				</div>
				
				
		</div>
	</div>

	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>

</body>
</html>