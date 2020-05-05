<?php 
	include 'php/conexion.php';
	session_start();


	$mensaje = $_SESSION ['mensaje'];




?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device‐width, initial‐scale=1.0,
maximum‐scale=1.0, user‐scalable=no">
	<title>Iniciar sesión</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

	<center>
	<main  class="container">
		<img src="img/logo1.png" class="corpo" alt="">
		<br>
		<br>
		<br>
		<br>

		<?php if ($mensaje == 1): ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
				Usuario y contraseña incorrecta inténtalo nuevamente.
				<?php $_SESSION['mensaje'] = ''; ?>
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			 	 </button>
			</div>
		<?php endif ?>

		<div   class="login-box">	
			<h3>SICEP</h3>
			<h5>Iniciar Sesión</h5>
			<form   method="post" action="php/entrar.php">
				<div class="form-group">
				<label for="usuario">Nombre de Usuario</label>
					<input type="text" name="usuario" placeholder="Ingrese su usuario" class="form-control">
				</div>
				<div class="form-group">
				<label for="password">Contraseña</label>
					<input type="password" name="password" placeholder="Ingrese la contraseña" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="" class="btn btn-primary" value="Iniciar Sesión">
				</div>
			</form>
		</div>
	</main>

	

	</center>
	<script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script type="text/javascript" src="js/main.js"></script>
</html>

