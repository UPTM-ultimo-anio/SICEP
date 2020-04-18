<?php
	session_start();  

	include("../php/conexion.php");
	include ("../php/funciones.php");

	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    $mensaje = $_SESSION ['mensaje'];

	//setlocale(LC_ALL,"es_ES");
  	$hora = date('H:i:s a');
	$fecha = date('d/m/Y ');
	//echo "$fecha";
    
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  	
  	<title>Consulta de la Persona</title>
    
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/main.css">

  
	
</head>
<body>

	<?php include ("menu.php"); ?>

	<?php 
		$x1=$_GET['codigo'];
		$result = mostrarFuncionario($x1);

		if(mysqli_num_rows($result) > 0){
			 while($datos=mysqli_fetch_array($result)) {

            	$nacimiento = new DateTime($datos['fec_nac_fun']);
            	$hoy = new DateTime();
            	$annos = $hoy->diff($nacimiento);
            	$edad = $annos->y;



	?>


	<div class="container-fluid">
		<div class="row">
			<ul class="col-md-2 d-none d-md-block bg-light sidebar">
			  <li class="nav-item">
			    <a class="nav-link active" href="insertar_familiar.php?ced_exp=<? echo $x1 ?>">Familiares</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="cargos.php?ced_exp=<? echo $x1 ?>">Cargos</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="actualizar_funcionario.php?ced_exp=<? echo $x1 ?>">Actualizar</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="#" data-toggle="modal" data-target="#ModalCenter">Ayuda</a>
			  </li>
			  <li class="nav-item">
			    <a class="nav-link" href="consulta_funcionario.php" tabindex="-1" aria-disabled="false">Regresar</a>
			  </li>
			</ul>
		

		<main class="col-md-10 ml-sm-auto col-lg-10 px-4">
			<div class="table-responsive container">
				<h2 class="text-center"> Consulta de Expediente</h2>
				<h4 class="text-center"> Datos Basicos o personales</h4>
				<table class="table table-bordered table-hover">
					<tr>
						<td class="text-capitalize"><strong>Cédula: </strong> <?php echo $datos['ciu_exp'],"-",$datos['ced_fun'];?></td>
						<td class="text-capitalize"><strong>Nombre: </strong><?php if ($datos['nom_fun']=='') {
							echo "No tiene dato";
						}else echo $datos['nom_fun'];?></td>
						<td class="text-capitalize"><strong>Apellido: </strong><?php echo $datos['ape_fun'];?></td>
					</tr>
					<tr>
						<td class="text-capitalize"><strong>Fecha de Nacimiento: </strong><?php echo date('d-m-Y',strtotime($datos['fec_nac_fun']));?></td>
						<td class="text-capitalize"><strong>Lugar de Nacimiento: </strong><?php if ($datos['lug_nac_fun']=='') {
							echo "No tiene dato";
							}else echo $datos['lug_nac_fun'];?></td>
						<td class="text-capitalize"><strong>Pais: </strong><?php if ($datos['pai_fun']=='') {
							echo "No tiene dato";
						}else echo $datos['pai_fun'];?></td>
					</tr>
					<tr>
						<td class="text-capitalize"><strong>Teléfono: </strong><?php if ($datos['tel_exp']=='') {
							echo "No aplica";
						}else echo $datos['cod_area'].'-'.$datos['tel_exp'];?>
						</td>
						<td><strong>Estado civil: </strong><?php echo $datos['est_civ_exp'];?></td>
						<td><strong>Edad: </strong><?php echo $edad; ?></td>
					</tr>
					<tr>
						<td class="text-center" colspan="3" ><strong >Dirección</strong></td>
					</tr>
					<tr>
						<td class="text-capitalize" colspan="3"><?php if ($datos['dir_exp']=='') {
							echo "No tiene dato";
						}else echo $datos['dir_exp'];?></td>
					</tr>
			</table>
			</div>
			<?php  
				$resulta = expedienteFuncionarioMostrar($x1);
				#echo $resulta;

				$expediente = $resulta->fetch_assoc();

			?>
			<div class="table-responsive container">
				<h4 class="text-center"> Datos del Trabajador</h4>
				<table class="table table-bordered table-hover">
					<tr>
						<td class="text-capitalize"><strong>Cargo: </strong> <?php echo $expediente['nom_car']; ?></td>
						<td class="text-capitalize"><strong>Departamento: </strong><?php if ($expediente['nom_dep']=='') {
							echo "No tiene dato";
						}else echo $expediente['nom_dep'];?></td>
						<td class="text-capitalize" colspan="2"><strong>Fecha de Ingreso: </strong><?php echo date('d-m-Y',strtotime($expediente['f_ing_exp']));?></td>
					</tr>
					<tr>
						<td class="text-capitalize"><strong>Fecha de Retiro: </strong><?php if ($expediente['f_ret_exp']=='') {
							echo "Aun no se ha retirado";
						}else echo date('d-m-Y',strtotime($expediente['f_ret_exp']));?></td>
						<td class="text-capitalize"><strong>Estado del Funcionario </strong><?php if ($expediente['cond_exp']=='') {
							echo "No tiene dato";
							}else echo $expediente['cond_exp'];?></td>
						<td class="text-capitalize"><strong>Contratación: </strong><?php if ($expediente['est_fun']=='') {
							echo "No tiene dato";
						}else echo $expediente['est_fun'];?></td>
						<td class="text-capitalize"><strong>Tipo de trabajador: </strong><?php if ($expediente['estatus_car']=='') {
							echo "No tiene dato";
						}else echo $expediente['estatus_car'];?></td>
					</tr>
			</table>
			</div>
			
		</main>
	
		</div>
	</div>

	<?php 
			}
		}else{
			echo"<center>";
			    echo "No fué posible realizar la operación solicitada  ".$x1;
		    echo"</center>";
			  
			echo"<center>";
			  echo"<div class='button black'><a href='consulta_funcionario.php'>Intentar nuevamente</a></div>";
			echo"</center>";
			  }

			echo"</center>";
			echo"</form>";

			// Cerramos la conexión
			mysqli_close($conexion);
			  

	 ?>


	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <script src="../js/main.js"></script>

</body>
</html>