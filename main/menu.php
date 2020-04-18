<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">

	
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light bg-dark" >
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
	    <a class="navbar-brand" style="color: white;" href="#">SICEP</a>
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
	      <li class="nav-item active">
	        <a class="nav-link" style="color: white;" href="#">Inicio <span class="sr-only">(current)</span></a>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
	          Expediente
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="registro_expediente.php">Registro</a>
	          <a class="dropdown-item" href="consulta_funcionario.php">Consulta</a>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
	          Vacaciones
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="solicitar_vacaciones.php">Solicitar Vacaciones</a>
				
	        </div>
	      </li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
	          Reportes
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="cronologica.php">Constancias Cronologicas</a>
	          <a class="dropdown-item" href="personal.php">Personal de Corposalud</a>
      		</li>
	      <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
	          Usuarios
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="register_user.php">Registrar Usuarios</a>
	          <a class="dropdown-item" href="consulta_user.php">Consultar</a>
	        </div>
	      </li>
		  <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
	          Herramientas
	        </a>
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="#">Respaldo</a>
	          <a class="dropdown-item" href="#">Restauración</a>
	          <a class="dropdown-item" href="accion.php">Bitacora de Acción</a>
	          <a class="dropdown-item" href="ruta.php">Bitacora de Ruta</a>
	          <div class="dropdown-divider"></div>
	          <a class="dropdown-item" href="#">Manual de Usuarios</a>
	          <a href="creditos.php" class="dropdown-item">Creditos</a>
	        </div>
	      </li>
		  <li class="nav-item">
	        <a class="nav-link" style="color: white;" href="cerrar_sesion.php">Salir</a>
	      </li>	      
	    </ul>
		    <div class="d-flex flex-row justify-content-center dropdown">
		        <button  class="btn btn-outline-light dropdown-toggle" type="button" id="dropdownMenuBoton"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">Perfil <span class="fa fa-user-circle"></span></button>
		        <div class="dropdown-menu" aria-labelledby="dropdownMenuBoton">
		          <a href="">  <span class="fa fa-user-circle" ></span></a>
		          <a href="perfil.php" class="dropdown-item">Mis datos</a>
		          <a href="cambio_clave.php " class="dropdown-item">Cambio de clave </a>
	        </div>
	  </div>
	</nav>

</body>
</html>