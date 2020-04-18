<?php 
	session_start();
	include '../php/conexion.php';
	include '../php/funciones.php';
	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    if(isset($_POST['buscar'])){
    	$fecha1 = $_POST['fecha_inicio'];
		$fecha2 = $_POST['fecha_fin'];

		$result = consultaBitacora($fecha1,$fecha2,$usuario);
    }




?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Bitacora ruta</title>
</head>
<body>
	<?php include("menu.php"); ?>

	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">


<br>
<div class="container">
<form method="post">
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="fecha_inicio">Fecha de inicio</label>
			<input type="date" name="fecha_inicio" class="form-control">
		</div>
		<div class="form-group col-md-4">
			<label for="fecha_fin">Fecha fin</label>
			<input type="date" name="fecha_fin" class="form-control">
		</div>
		<div class="form-group col-md-4">
			<label></label>
			<button type="submit" name="buscar" class="btn btn-success btn-sm btn-block form-inline">Buscar</button> 
		</div>
	</div>


</form>
</div>

<br>
<h3 class="bg-primary text-center pad-basic no-btm">Bitacora</h3>
<br>

<?php  
	if ($result->num_rows>0) {
?>
	<div class="table-responsive container">
		<table class="table">
			<thead class="thead-dark">
				<tr>
					<th scope="col">Usuario</th>
					<th scope="col">Fecha y Hora</th>
					<th scope="col">Ruta</th>
				</tr>
			</thead>
			<tbody>
				<?php
					while ($fila = $result->fetch_assoc()) {
				?>
					<tr>
						<td><? echo $fila['username'];?></td>
						<td><? echo date('d-m-Y g:i:s a',strtotime($fila['fecha_ruta']));?></td>
						<td><? echo $fila['ruta'];?></td>
					</tr>
				<?php 
					} 
				?>


<?php  
	}
?>

	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>