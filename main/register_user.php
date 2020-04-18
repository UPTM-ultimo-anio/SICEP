<?php 

	session_start();
	include '../php/conexion.php';
	include '../php/funciones.php';
	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);
    $mensaje = $_SESSION['mensaje'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Registrar Usuario</title>


	<link rel="stylesheet" type="text/css" href="../css/main.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
</head>
<body>
	
	<?php include 'menu.php'; ?>

		<br>



	<div class="container margin-top-6">
		<h3 class="bg-primary text-center pad-basic no-btm text-white">Registrar Usuarios</h3>

		<?php if (strlen($mensaje) > 0 ): ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
				<?php echo $mensaje; 
					$_SESSION['mensaje'] = '';
				?>
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			 	 </button>
			</div>
		<?php endif ?>	
	</div>

	<div class="container">
		<form class="form" method="post" action="registrar_usuarios.php">
			<div class="row">
				<div class="form-group col-md-4 container">
					<label for="username">Nombre de Usuario</label>
					<input type="text" class="form-control" name="username" required>
					<input type="hidden" name="status" value="1">
				</div>
				<div class="form-group col-md-4 container">
					<label for="cedula">Tipo de usuario</label>
					<select class="custom-select custom-select-md mb-3" name="id_tipo" id="id_tipo" required>
						<option selected>Seleccione</option>
						<option value="1">Administrador</option>
						<option value="2">Secretario</option>
					</select>

				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4 container">
					<label for="username">Nombre</label>
					<input type="text" class="form-control" name="nombre" id="nombre" required>
				</div>
				<div class="form-group col-md-4 container">
					<label for="username">Apellido</label>
					<input type="text" class="form-control" name="apellido" id="apellido" required>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-md-4 container">
					<label for="password">Contraseña</label>
					<input type="password" class="form-control" minlength="8" maxlength="20" name="password" required>
				</div>
				<div class="form-group col-md-4 container">
					<label for="password">Confirmar Contraseña</label>
					<input type="password" class="form-control" minlength="8" maxlength="20" name="password2" required>
				</div>	
			</div>
			<div class="row">
				<div class="form-group container">
					<button type="submit" class="btn btn-primary btn-lg" name=registrar>Registrar</button>
				</div>
			</div>
		</form>
	</div>





	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>