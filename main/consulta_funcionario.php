<?php
	include("../php/conexion.php");
	include ("../php/funciones.php");
    $pagina = $_GET['pagina'];

    session_start();
    $_SESSION['variable']=$pagina;

    #if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
   	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);
/*
    if (!$_GET) {
      header('Location:'.$url.'?pagina=1');
    }
*/
        //echo $x1;
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!--<link rel="stylesheet" type="text/css" href="../../css/estilo.css"> -->
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
  
    
	<title>Consulta de personales</title>


</head>
<body>

	<?php include ("menu.php"); ?>

	<main class="container">

		<h1 class="text-center">Personal de Corposalud del Estado Mérida</h1>
		
		<div class="form-group mb-3">
			<label for="caja_busqueda">Buscar</label>
			<input type="text" class="form-control" name="caja_busqueda" id="caja_busqueda" placeholder="Ingrese cedula, nombre o apellido para buscar"></input>

			
		</div>


		<div id="datos" >

	        <?
	            //echo "<script>alert('".$_GET['pagina']."')</script>";
	        ?>
	       

		</div>

	</main>

	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <script src="../js/main.js"></script>

</body>

</html>