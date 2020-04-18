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
  	
  	<title>Familiares</title>
    
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

	
</head>
<body>
	<?php include ("menu.php"); ?>
	<br>

	<main class="container">

		<div class="table-responsive">
			<table class="table table-hover">
			  <thead class="thead bg-primary text-white">
			    <tr>
			      <th scope="col">Cédula</th>
			      <th scope="col">Nombre</th>
			      <th scope="col">Apellido</th>
			      <th scope="col">Fecha de nacimiento</th>
			      <th scope="col">Parentesco</th>
			      <th scope="col" colspan="2">Herramientas</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php 
			  		$result = consultarFamiliar($ced_exp);
			  		while($fila = $result->fetch_assoc())
				  	{
				?>
					<tr>
						<td><? echo $fila['ced_fam'];?></td>
						<td><? echo $fila['nom_fam'];?></td>
						<td><? echo $fila['ape_fam'];?></td>
						<td><? echo date('d-m-Y',strtotime($fila['fec_fam']));?></td>
						<td><? echo $fila['nom_par'];?></td>
						<td><a href=actu_fami.php?codigo=<?php  echo $fila['ced_fun'].'&ced_fam='.$fila['ced_fam']; ?>><img src="../img/editar.png" width="25" alt="Edicion"></a></td>
						<td><a  href=eli_fam.php?codigo=<?php  echo $fila['ced_fun'].'&ced_fam='.$fila['ced_fam']; ?>><img src='../img/eliminar.png' width='25' alt='Edicion' onclick='return Confirmation()'></a></td>
					
					</tr>

				<?php
				  	}

				?>
					
			  </tbody>
			</table>
		</div>

		<div class="">
			<h3 class="bg-primary text-center pad-basic no-btm">Agregar Nuevo familiar</h3>
			<form class="bg-light" action="registrar_familiar.php" name="" method="post">
				<div class="form-row">
					<input type="hidden" name="ced_exp" value="<?php echo $ced_exp ?>">
					<div class="form-group col-lg-2 col-md-6">
						<label for="ced_fam">Cédula del familiar</label>
						<input type="text" class="form-control" name="ced_fam" id="ced_fam">
					</div> 
					<div class="form-group col-lg-3 col-md-6">
						<label for="nom_fami">Nombre del familiar</label>
						<input type="text" class="form-control" name="nom_fam" id="nom_fam">
					</div>
					<div class="form-group col-lg-3 col-md-4">
						<label for="ape_fami">Apellido del familiar</label>
						<input type="text" class="form-control" name="ape_fam" id="ape_fam">
					</div>
					<div class="form-group col-lg-2 col-md-4">
						<label for="fec_fam">Fecha de nacimiento</label>
						<input type="date" class="form-control" name="fec_fam" id="fec_fam">
					</div>
					<div class="form-group col-lg-2 col-md-4">
						<label for="tip_par">Tipo de Parentesco</label>
						<select class="custom-select custom-select-md mb-3" name="tip_par" id="tip_par" >
							<option  value="">Seleccione</option>
							<?php 
								$result = mostrarParentesco();
								while($parentesco = mysqli_fetch_array($result)){
							?>
								<option value="<?php echo $parentesco['tip_par']; ?>"><?php echo $parentesco['nom_par']; ?></option>';
		                    <?php
		                  	  }
		                    ?>
		                  
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 col-10">
						
					</div>
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 col-2">
					<input type="submit"  class="btn btn-primary" id="insertar" name="insertar" value="Agregar">
					</div>

				</div>
			</form>

			
			
		</div>

		<div class="col-lg-4">
			<form method="post">
					<input type="submit" name="regresar" id="regresar" class="btn btn-secondary" value="Regresar">
			</form>		
		</div>

	</main>



	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script src="../js/main.js"></script>

</body>
</html>