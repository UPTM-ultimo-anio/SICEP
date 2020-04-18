<?php
	include("../php/conexion.php");
	include ("../php/funciones.php");
;

    session_start();

    #if(!isset($_SESSION['id_cedu']))header("location: ../../index.php");
   	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

    registrarBitacora($usuario,$enlace_actual);

    $cedula = $_GET['ced_exp'];


    $result = mostrarParaActualizar($cedula);

    $datos=$result->fetch_assoc();

    if(isset($_POST['regresar'])){
			#echo "<script>window.location='consulta.php?codigo=".$ced_exp."'</script>";
			header("location: consulta.php?codigo={$cedula}");
	}


?>

<!DOCTYPE html>
<html lang="es">
<head>
	<!--<link rel="stylesheet" type="text/css" href="../../css/estilo.css"> -->
	<meta charset="utf-8">

	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="../css/main.css">
      
	<title>Actualizar Funcionario</title>


</head>
<body>

	<?php include 'menu.php';	?>
		
	
	<div class="container">
		<div class="row">	
		<div class="col-8">	
			<h2 class="text-center">Actualizar los datos del Funcionario</h2>
		</div>
		<div class="col-lg-4">
			<form method="post">
					<input type="submit" name="regresar" id="regresar" class="btn btn-secondary" value="Regresar">
			</form>		
		</div>
		</div>
			<form action="act_fun.php" method="post">
				<input type="hidden" name="ced_exp" value="<?php echo $datos['ced_fun'] ?>">
				<div class="row">
					<div class="form-group col-sm-5">
		    			<label for="nom_fun">Nombre</label>
		      			<input  required  type="text" class="form-control" id="nom_fun" name="nom_fun" value="<?PHP echo $datos['nom_fun']; ?>" placeholder="" required>
	    			</div>
				    <div class="form-group col-sm-5">
				      <label for="ape_fun">Apellido</label>
				      <input type="text"   class="form-control" id="ape_fun" name="ape_fun" placeholder="" value="<?PHP echo $datos['ape_fun']; ?>" required >
				    </div>
					<div class="form-group col-sm-2">
					    <label for="exampleFormControlSelect1">Ciudadania</label>
					    <select  class="custom-select custom-select-md mb-3" id="exampleFormControlSelect1" name="ciu_exp">
					      	<option <?php if(strcmp($datos['ciu_exp'], 'V')==0){ echo "selected "; } ?>VALUE="V">Venezolano</option>
						  	<option <?php if(strcmp($datos['ciu_exp'], 'E')==0){ echo "selected "; } ?>VALUE="E">Extranjero</option>
					    </select>
					</div>
				</div>
				<div class="row">					
					<div class="form-group col-sm-3">
					   	<label for="lug_nac_fun">Lugar de Nacimiento</label>
					   	<input type="text" required class="form-control" id="lug_nac_fun" name="lug_nac_fun" value="<?PHP echo $datos['lug_nac_fun']; ?>">
					</div>
					<div class="form-group col-sm-3">
					  	<label for="pai_fun">País</label>
					   	<input required type="text" class="form-control" id="pai_fun" name="pai_fun" value="<?PHP echo $datos['pai_fun']; ?>">
					</div>
					<div class="form-group col-sm-3">
					  	<label for="fec_nac_fun">Fecha de Nacimiento</label>
					   	<input required type="date" class="form-control" id="fec_nac_fun" name="fec_nac_fun" placeholder="" value="<?PHP echo $datos['fec_nac_fun']; ?>" >
					</div>
					<div class="form-group col-sm-3">
					     <label for="est_civ_exp">Estado Civil</label>
					     <select name="est_civ_exp" class="custom-select custom-select-md mb-3" id="exampleFormControlSelect1" />
				              <option value="">Seleccione</option>           
			              	  <option <?php if(strcmp($datos['est_civ_exp'], 'Soltero')==0){ echo "selected "; } ?>VALUE="Soltero">Soltero</option>
							  <option <?php if(strcmp($datos['est_civ_exp'], 'Casado')==0){ echo "selected "; } ?>VALUE="Casado">Casado</option>
				              <option <?php if(strcmp($datos['est_civ_exp'], 'Viudo')==0){ echo "selected "; } ?>VALUE="Viudo">Viudo</option>
				              <option <?php if(strcmp($datos['est_civ_exp'], 'Divorciado')==0){ echo "selected "; } ?>VALUE="Divorciado">Divorciado</option>
				              <option <?php if(strcmp($datos['est_civ_exp'], 'Unión estable de hecho')==0){ echo "selected "; } ?>VALUE="Unión estable de hecho">Unión estable de hecho</option>
			          	 </select>
					</div>
			    </div>
			    <div class="row">
			    	<div class="form-group col-sm-12">
				  		<label for="dir_exp">Direccion</label>
				  		<textarea required class="form-control" id="dir_exp" name="dir_exp" placeholder="" ><?php echo $datos['dir_exp']; ?></textarea>
					</div>    		
				</div>
				<div class="dropdown-divider"></div>
		  		<div class="row">
		  		<div class="form-group col-sm-4">
		  			<label for="f_ing_exp">Fecha de ingreso</label>
		  			<input type="date" name="f_ing_exp" class="form-control" id="f_ing_exp" value="<?php echo $datos['fec_ing_fun']; ?>" >
		  		</div>
				<div class="form-group col-sm-4">
		  			<label for="est_exp">Estatus</label>
		  			<select class="custom-select custom-select-md mb-3" name="est_fun">
		  		  		<option value="">Seleccione</option>
		          		<option <?php if(strcmp($datos['est_fun'], 'Ministerio')==0){ echo "selected "; } ?> value="Ministerio">Ministerio</option>
			            <option <?php if(strcmp($datos['est_fun'], 'Ejecutivo')==0){ echo "selected "; } ?> value="Ejecutivo">Ejecutivo</option>
		            </select>
		        </div>
        		<div class="form-group col-sm-4">
	  				<label for="est_exp">Estatus</label>
	  				<select name="cond_exp" class="custom-select custom-select-md mb-3">
	  					<option value="">Seleccione</option>            
	              		<option <?php if(strcmp($datos['cond_exp'], 'Pasivo')==0){ echo "selected "; } ?>VALUE="Pasivo">Pasivo</option>
						<option <?php if(strcmp($datos['cond_exp'], 'Activo')==0){ echo "selected "; } ?>VALUE="Activo">Activo</option>
	  				</select>
				</div>
				<input class="container btn btn-lg btn-primary btn-block col-sm-9" name="boton" id="boton" type="submit" value="Actualizar" />
				</div>
			</form>
		</div>


	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>

    <script src="../js/main.js"></script>

</body>

</html>
