<?php
	session_start();
	include '../php/conexion.php';
	include '../php/funciones.php';
	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    $ced_exp = isset($_POST['ced_fun']) ? $_POST['ced_fun'] : '';

    if (isset($_POST['boton'])) {
    	$ced_fun = isset($_POST['ced_fun']) ? $_POST['ced_fun'] : '';
    	$base = funcionario($ced_fun);
    	$result = mostrarExpediente($ced_fun);

    }

	if(isset($_POST['continuar'])){
		echo "<script>nuevaVentana= window.open('constancias.php?ced_exp=".$ced_exp."')</script>";
	}
 

	
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Constancias Cronologicas</title>
	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	<?php include 'menu.php'; ?>

<div class="container">
	<h3 class="text-center">Constancias Cronologicas</h3>
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
	

	<?php if ($base->num_rows>0): 
		$crono = $base->fetch_assoc();
	?>
	<div class="table-responsive">
		<h3 class="bg-light text-center pad-basic no-btm text-black">Constancias Cronologicas</h3>
		<table class="table">
			<tr>
       			<td colspan="2" align="center"><strong>Cédula: </strong><?php echo $crono['ced_fun']; ?>
          		<input type="hidden" name="ced_exp" cols="888" id="ced_exp" value="<?php echo $crono['ced_fun']; ?>" /></td>
      			<td colspan="2"><strong>Nombre y Apellido: </strong><?php echo $crono['nom_fun']." ".$crono['ape_fun']; ?></td>
    		</tr>
    		<tr >
				<th >Cargo</th>
                <th >Departamento</th>
				<th >Fecha de ingreso</th>
				<th >Fecha de retiro</th>
			</tr>
			<?php 
				while ($row = $result->fetch_assoc()) 
				{
			?>
				<tr>
					<td><?php echo $row['nom_car']; ?></td>
					<td><?php echo $row['nom_dep']; ?></td>
					<td><?php echo date('d-m-Y', strtotime($row['fec_car_ing'])); ?></td>
					<td><?php if ($row['fec_ret_car']== '0000-00-00'){echo 'Esta Activo';}
							else {echo date('d-m-Y', strtotime($row['fec_ret_car'])); } ?></td>
				</tr>
			<?php
				}
			?>
			
		</table>
		<center>

			<button class="btn btn-secondary"  id="boton" name="continuar" value="Continuar">Continuar</button>
		</center>
		</form>
	</div>
	<?php endif ?>

</div>


	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>