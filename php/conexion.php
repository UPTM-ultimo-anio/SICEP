<?php 
// Creamos el objeto de conexión a la base de datos indicando las constantes de conexión
$conexion = new mysqli('localhost', 'root', '1234567890', 'sicep_bd');

// Hacemos una prueba de fallos con connect_errno por medio de un if
if ($conexión->connect_errno) {
	echo 'Se ha producido un error en la conexión';
	exit;
} else {

	//echo 'Conexión exitosa';
}

if (!mysqli_set_charset($conexion, "utf8")) {
	//printf("Error loading character set utf8: %s\n", mysqli_error($conexion));
	exit();
} else {
	//printf("Current character set: %s\n", mysqli_character_set_name($conexion));
}


?>