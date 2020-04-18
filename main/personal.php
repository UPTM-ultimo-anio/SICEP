<?
	session_start();
	include '../php/conexion.php';
	include '../php/funciones.php';
	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);


	$result = listadoFuncionario();

	if(isset($_POST['imprimir']))
	{
		//echo 'imprimido';
		echo "<script>nuevaVentana= window.open('reportes.php')</script>";
	}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Personas que trabajan en Corposalud</title>

	

    <!--Aplicando bootstrap -->
    <link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>

	<? include('menu.php'); ?>
	<br>
	<div class="container margin button 6">
		<h3 class="bg-info text-center pad-basic no-btm text-white">Personal de la Corporación de Salud del estado Mérida</h3>
	</div>
	<div class="container table-responsive sm">
	<table class="table">
	<thead>
    <tr>
      <th scope="col">Cedula</th>
      <th scope="col">Nombre y Apellido</th>
      <th scope="col">Fecha de Ingreso</th>
      <th scope="col">Condición</th>
    </tr>
  </thead>
  <tbody>
	<?
	while($row = $result->fetch_assoc()){
		?>
		<tr>
			<td><?echo $row['ced_fun']; ?></td>
			<td><?echo $row['nom_fun'].' '.$row['ape_fun']; ?></td>
			<td><?echo date('d-m-Y',strtotime($row['fec_ing_exp'])); ?></td>
			<td><?echo $row['cond_exp']; ?></td>
		</tr>
		<?
	}
	?>
	</tbody>

	</table>
	<div align="center">

		<form action="" method="post">
		<button type="submit" name="imprimir" class="btn btn-success">Imprimir personal</button>
		</form>
	</div>

	</div>

	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>

</body>
</html>