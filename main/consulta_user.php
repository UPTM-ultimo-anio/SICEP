<?php 
	session_start();
	include '../php/conexion.php';
	include '../php/funciones.php';
	date_default_timezone_set("America/Caracas");
  	#if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
  	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    $result = listadoUsuarios();


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Consulta de Usuario</title>
	
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<div class="table-responsive container">
		<table class="table" id="tabla">
			<thead class="thead-dark bg-primary">
				<tr>
					<th scope="col">Username</th>
					<th scope="col">Nombre</th>
					<th scope="col">Apellido</th>
					<th scope="col">Tipo de usuario</th>
					<th scope="col">Status</th>
					<th scope="col">Herramientas</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row=$result->fetch_assoc()) { 
						$datos=$row['username']."||"
							  .$row['nombre']."||"
							  .$row['apellido']."||"
							  .$row['status'];
					?>	
					<tr>
						<td><?php echo $row['username'];?></td>
						<td><?php echo $row['nombre'];?></td>
						<td><?php echo $row['apellido'];?></td>
						<td><?php if ($row['id_tipo'] == 1){
								echo "Administrador";
							}else{
								echo "Secretario";
							}
							?></td>
						<td><?php if ($row['status'] == 1){
								echo "Activo";
							}else{
								echo "Desactivado";
							}
							?></td>
						<td><button type="button" class="btn btn-warning glyphicon glyphicon-pencil" id="modificar" name="modificar" data-toggle="modal"  data-target="#exampleModalCenter" onclick="agregar_form('<?php echo $datos ?>')">
							Modificar
							</button></td>
					</tr>
 				<?php } ?>
			</tbody>

		</table>
	</div>


	<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5  class="modal-title text-center" id="exampleModalLongTitle">Actualizar funcionario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<input type="hidden" name="" id="username" class="form-control input-sm">
      	<label>Nombre</label>
      	<input type="text" name="" id="nombre" class="form-control input-sm">
      	<label>Apellido</label>
      	<input type="text" name="" id="apellido" class="form-control input-sm">
      	<label>Status</label>
		<select id="status" class="form-control input-sm">
			<option value="1">Activo</option>
			<option value="0">Inactivo</option>
		</select>      	
      </div>
      <div class="modal-footer">
      	<button type="button" class="btn btn-primary" data-dismiss="modal" id="actualiza_user" name="actualiza_user">Actualizar datos</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        
      </div>
    </div>
  </div>
</div>
	


	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>