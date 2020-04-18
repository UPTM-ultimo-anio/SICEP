<?php 
	session_start();
	include ('../php/funciones.php');
	include ('../php/conexion.php');

	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	$fecha = strtotime(date("Y-m-d"));

	registrarBitacora($usuario,$enlace_actual);

	$boton = $_POST['boton'];

	if(isset($_POST['boton'])){

		 $ced_fun = isset($_POST['ced_fun']) ? $_POST['ced_fun'] : '';
		 $nom_fun = isset($_POST['nom_fun']) ? $_POST['nom_fun'] : '';
		 $ape_fun = isset($_POST['ape_fun']) ? $_POST['ape_fun'] : '';
		 $lug_nac_fun = isset($_POST['lug_nac_fun']) ? $_POST['lug_nac_fun'] : '';
		 $pai_fun = isset($_POST['pai_fun']) ? $_POST['pai_fun'] : '';
		 $fec_nac_fun = isset($_POST['fec_nac_fun']) ? $_POST['fec_nac_fun'] : '';
		 $cod_area = isset($_POST['cod_area']) ? $_POST['cod_area'] : '';
		 $tel_exp = isset($_POST['tel_exp']) ? $_POST['tel_exp'] : '';
		 $cor_fun = isset($_POST['cor_fun']) ? $_POST['cor_fun'] : '';
		 $est_civ_exp = isset($_POST['est_civ_exp']) ? $_POST['est_civ_exp'] : '';
		 $municipio = isset($_POST['municipio']) ? $_POST['municipio'] : '';
		 $parroquia = isset($_POST['parroquia']) ? $_POST['parroquia'] : '';
		 $dir_exp = isset($_POST['dir_exp']) ? $_POST['dir_exp'] : '';
		 $cond_exp = isset($_POST['cond_exp']) ? $_POST['cond_exp'] : '';
		 $est_fun = isset($_POST['est_fun']) ? $_POST['est_fun'] : '';
		 $estatus_car = isset($_POST['estatus_car']) ? $_POST['estatus_car'] : '';
		 $f_ing_exp = isset($_POST['f_ing_exp']) ? $_POST['f_ing_exp'] : '';
		 $ciu_exp = isset($_POST['inlineRadioOptions']) ? $_POST['inlineRadioOptions'] : '';
		 $cod_car = isset($_POST['cod_car']) ? $_POST['cod_car'] : '';
		 $cod_dep = isset($_POST['cod_dep']) ? $_POST['cod_dep'] : '';

		 #echo $cod_dep;

		 #echo strcmp($ciu_exp, 'V');

		 if (buscaRepetido($ced_fun) > 0 ) {
		 	$mensaje = "Estes Funcionario ya existe";
		 }elseif (strtotime($fec_nac_fun)>=$fecha) {
		 	$mensaje = "Esta persona no ha nacido";
		 }
		 else
		 {
		 	registrarFuncionario($ced_fun,$nom_fun,$ape_fun,$lug_nac_fun,$pai_fun,$fec_nac_fun,$cod_area,$tel_exp,$cor_fun,$est_civ_exp,$dir_exp,$cond_exp,$estatus_car,$f_ing_exp,$ciu_exp,$est_fun,'Movil 1',$cod_car,$cod_dep);
		 	$ced_fun = '';
		 	$nom_fun = '';
		 	$ape_fun = '';
		 	$lug_nac_fun = '';
			$pai_fun = '';
			$fec_nac_fun = '';
			$cod_area = '';
			$tel_exp = '';
			$cor_fun = '';
			$est_civ_exp = '';
			$municipio = '';
			$parroquia = '';
			$dir_exp = '';
			$cond_exp = '';
			$est_fun = '';
			$estatus_car = '';
			$f_ing_exp = '';
			$ciu_exp = '';
			$cod_car = '';
			$cod_dep = '';


		 	$mensaje = "Se ha registrado satisfastoriamente el  funcionario";

		 }
	 }
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Registro expediente</title>

	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php include 'menu.php'; ?>

	<div class="container">
		<h2 class="text-center"><strong>Registrar Persona</strong></h2>
		<?php if (strlen($mensaje) > 0 ): ?>
			<div class="alert alert-warning alert-dismissible fade show" role="alert" id="alert">
				<?php echo $mensaje; ?>
			  	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			 	 </button>
			</div>
		<?php endif ?>	
		<form method="post" action="">
		
			<div class="form-row col-12">
				<div class="form-group col-lg-4"></div>
				<div class="form-group col-lg-4 col-md-3 col-sm-12">
					<label for="ced_fun">Cédula</label>
					<input type="text" name="ced_fun" id="ced_fun" minlength="6" maxlength="9" class="form-control" value="<?php if (isset($ced_fun)){ 
						echo $ced_fun;
						} else{
						echo $_GET['ced_fun'];
						}
					?>" required></input>
				</div>
				<div class="form-group">
					<button type="button" class="btn btn-danger"  name="mostrar" data-toggle="modal" id="mostrar" data-target="#exampleModal">
  						Este funcionario ya existe
					</button>
				</div>
			</div>

			
	<div class="accordion" id="accordionExample">
		  <div class="card">
		    <div class="card-header" id="headingOne">
		      <h5 class="mb-0">
		        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          Datos Personales
		        </button>
		      </h5>
		    </div>

		    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
		      <div class="card-body">
		        <div class="form-row col-12">
						<div class="form-group col-lg-6 col-md-6 col-sm-12">
				            <label for="nom_fun">Nombres</label>
				            <input type="text" name="nom_fun" id="nom_fun_r" class="form-control" value="<?php if (isset($nom_fun)) echo $nom_fun; ?>" required>
				        </div>
				        <div class="form-group col-lg-6 col-md-6 col-sm-12">
				            <label for="ape_fun">Apellidos</label>
				            <input type="text" name="ape_fun" id="ape_fun_r" class="form-control" value="<?php if (isset($ape_fun)) echo $ape_fun; ?>" required>
				        </div>
					</div>
					<div class="form-row col-12">
				        <div class="form-group col-lg-2 col-md-6 col-sm-4" >
				            <label for="ciu_exp">Nacionalidad</label>
				                <div class="form-check form-check-inline form-inline">
				                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="V" <?php if (strcmp($ciu_exp, 'V') == 0) {
				                    	echo "checked";
				                    } ?>>
				                    <label class="form-check-label" for="inlineRadio1">V</label>
				                </div>
				                <div class="form-check form-check-inline" >
				                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="E" <?php if (strcmp($ciu_exp, 'E') == 0) {
				                    	echo "checked";
				                    } ?>>
				                    <label class="form-check-label" for="inlineRadio2">E</label>
				                </div>  
				        </div>
				        <div class="form-group col-lg-3 col-md-6 col-sm-6">
				            <label for="pai_fun">País</label>
				            <input type="text" name="pai_fun" id="pai_fun_r" class="form-control" value="<? if (isset($pai_fun)) echo $pai_fun; ?>" required>
				        </div>
				        <div class="form-group col-lg-3 col-md-6 col-sm-8">
				            <label for="nom_fun">Lugar de Nacimiento</label>
				            <input type="text" name="lug_nac_fun" id="lug_nac_fun_r" class="form-control" value="<?php if (isset($lug_nac_fun)) echo $lug_nac_fun; ?>" required>
				        </div>
				        <div class="form-group col-lg-4 col-md-6 col-sm-6">
				            <label for="fec_nac_fun">Fecha de Nacimiento</label>
				            <input type="date" name="fec_nac_fun" id="fec_nac_fun_r" class="form-control" value="<?php if (isset($fec_nac_fun)) echo $fec_nac_fun; ?>" required>
				        </div>
			    	</div>
			    	<div class="form-row col-12"> 
				        <div class="form-group col-lg-2 col-md-4 col-sm-4">
				            <label for="tel_exp">Código</label>
				            <select class="form-control" name="cod_area" id="area_tel_r" >
				                <option selected>----</option>
				                <option <?php if(strcmp($cod_area, '0416')==0){ echo "selected "; } ?> value="0416">0416</option>
				                <option <?php if(strcmp($cod_area, '0426')==0){ echo "selected "; } ?> value="0426">0426</option>
				                <option <?php if(strcmp($cod_area, '0414')==0){ echo "selected "; } ?> value="0414">0414</option>
				                <option <?php if(strcmp($cod_area, '0424')==0){ echo "selected "; } ?> value="0424">0424</option>
				                <option <?php if(strcmp($cod_area, '0412')==0){ echo "selected "; } ?> value="0412">0412</option>
				                <option <?php if(strcmp($cod_area, '0271')==0){ echo "selected "; } ?> value="0271">0271</option>
				                <option <?php if(strcmp($cod_area, '0274')==0){ echo "selected "; } ?> value="0274">0274</option>
				                <option <?php if(strcmp($cod_area, '0275')==0){ echo "selected "; } ?> value="0275">0275</option>
				            </select>
				        </div>
				        <div class="form-group col-lg-3 col-md-8 col-sm-8">
				            <label for="tel_exp">Teléfono</label>
				            <input type="text" class="form-control" minlength="7" maxlength="7"  id="tel_exp_r" name="tel_exp" value="<?php if (isset($tel_exp)) echo $tel_exp; ?> ">
				        </div>
				        <div class="form-group col-lg-4 col-md-7 col-sm-6">
				            <label for="cor_fun">Correo</label>
				            <input type="email" class="form-control" minlength="" maxlength=""  id="cor_fun_r" name="cor_fun" placeholder=" " value="<?php if (isset($cor_fun)) echo $cor_fun; ?> ">
				        </div>
				        <div class="form-group col-lg-3 col-md-5 col-sm-6">
				            <label for="est_civ_exp">Estado Civil</label>
				            <select class="custom-select custom-select-md mb-3" name="est_civ_exp" id="est_civ_exp_r" required="">
				            	<option value="">Seleccione</option>
				                <OPTION <?php if(strcmp($est_civ_exp, 'Soltero')==0){ echo "selected "; } ?>VALUE="Soltero">Soltero</OPTION>
				                <OPTION <?php if(strcmp($est_civ_exp, 'Casado')==0){ echo "selected "; } ?>VALUE="Casado">Casado</OPTION>
				                <OPTION <?php if(strcmp($est_civ_exp, 'Viudo')==0){ echo "selected "; } ?>VALUE="Viudo">Viudo</OPTION>
				                <OPTION <?php if(strcmp($est_civ_exp, 'Divorciado')==0){ echo "selected "; } ?>VALUE="Divorciado">Divorciado</OPTION>
				                <OPTION <?php if(strcmp($est_civ_exp, 'Unión estable de hecho')==0){ echo "selected "; } ?>VALUE="Unión estable de hecho">Unión estable de hecho</OPTION>
				            </select>
				        </div>
				    </div>
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingTwo">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          Dirección
		        </button>
		      </h5>
		    </div>
		    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
		    	<div class="card-body">
		        	<div class="form-row col-12">
		        		<div class="form-group col-sm-6">
		        			<label for="municipio">Municipio</label>
		        			<input type="text" class="form-control" id="municipio_r" name="municipio" value="<?php if (isset($municipio)) echo $municipio; ?>" required>
		        		</div>
		        		<div class="form-group col-sm-6">
		        			<label for="parroquia">Parroquia</label>
		        			<input type="text" class="form-control" id="parroquia_r" name="parroquia" value="<?php if (isset($parroquia)) echo $parroquia; ?>" required>
		        		</div>
		        	</div>
		        	<div class="form-row col-12">
		        		<div class="form-group col-sm-12">

				            <label for="dir_exp">Dirección</label>
				            <textarea class="form-control" id="dir_exp_r" name="dir_exp" placeholder=""  required=""><?php if (isset($dir_exp)) echo $dir_exp; ?></textarea>
				        </div>
		        	</div>
				     
		    	</div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingThree">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		          Datos del Trabajador
		        </button>
		      </h5>
		    </div>
		    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
		    	<div class="card-body">
		            <div class="form-row col-12">
					        <div class="form-group col-sm-6">
					            <label for="cond_exp">Estado del Trabajador</label>
					            <select class="custom-select custom-select-md mb-3" name="cond_exp"  id="cond_exp_r" required>
					                <option value="">Seleccione</option>
					                <option  <?php if(strcmp($cond_exp, 'Activo')==0){ echo "selected "; } ?> value="Activo">Activo</option>
					                <option  <?php if(strcmp($cond_exp, 'Pasivo')==0){ echo "selected "; } ?> value="Pasivo">Pasivo</option>
					            </select>
					        </div>
					        <div class="form-group col-sm-6">
					            <label for="estatus_car">Tipo de trajador</label>
					            <select class="custom-select custom-select-md mb-3" name="estatus_car" id="estatus_car_r" required>
					                <option value="" disabled>Seleccione</option>
					                <option  <?php if(strcmp($estatus_car, 'Fijo')==0){ echo "selected "; } ?> value="Fijo">Fijo</option>
					                <option  <?php if(strcmp($estatus_car, 'Contratado')==0){ echo "selected "; } ?> value="Contratado">Contratado</option>
					            </select>
					        </div>
					</div>
			        <div class="form-row col-12">
					        <div class="form-group col-sm-6">
					            <label for="f_ing_exp">Fecha de ingreso</label>
					            <input type="date" name="f_ing_exp" class="form-control" required id="f_ing_exp_r" value="<?php if (isset($f_ing_exp)) echo $f_ing_exp; ?>">
					        </div>
						    <div class="form-group col-sm-6">
						        <label for="est_exp">Contratación del Trabajador</label>
						        <select class="custom-select custom-select-md mb-3" name="est_fun" required id="est_fun_r" required="">
						            <option value="">Seleccione</option>
						            <option  <?php if(strcmp($est_fun, 'Ministerio')==0){ echo "selected "; } ?> value="Ministerio">Ministerio</option>
						            <option  <?php if(strcmp($est_fun, 'Ejecutivo')==0){ echo "selected "; } ?> value="Ejecutivo">Ejecutivo</option>
						        </select>   
					        </div>
					</div>
				    <div class="form-row col-12">
				    		<div class="form-group col-sm-6">
				    			<label for="cargo">Cargo</label>
				    			<select name="cod_car" id="cod_car_r" class="custom-select custom-select-md mb-3" required>
				    				<option value="">Seleccione</option>
				    				<?php 
										$lis_car = mostrarCargos();
										while ($cargos = mysqli_fetch_array($lis_car)) {
									?>
									<option value="<?php echo $cargos['cod_car']; ?>"><?php echo $cargos['nom_car']; ?></option>
									<?php
										}

									?>
				    			</select>
				    		</div>
					       	<div class="form-group col-sm-6">
				    			<label for="departamento">Departamento</label>
				    			<select name="cod_dep" id="cod_dep_r" class="custom-select custom-select-md mb-3" required>
				    				<option value="">Seleccione</option>
				    				<?php 
										$lis_dep = mostrarDepartamento();
										while ($departamentos = mysqli_fetch_array($lis_dep)) {
									?>
									<option value="<?php echo $departamentos['cod_dep']; ?>"><?php echo $departamentos['nom_dep']; ?></option>
									<?php
										}

									?>
				    			</select>
				    		</div>
			    	</div>
		    	</div>
		    </div>
		  </div>
		</div>
	

	    	<div class="form-row">
	    		<div class="form-group col-lg-5"></div>
	    		<div class="form-group col-lg-4">
	        	<button class="btn btn-info" type="submit" name="boton" id="funcionario_registrar" value="Registrar">Registrar</button>
	    		</div>
	    	</div>

		</form>
	</div>

	<!-- Button trigger modal -->


<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLabel">¿Deséa modificarlo?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	      	<center>
				<button type="button" class="btn btn-primary">Si</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
	      	</center>
	      </div>
	    </div>
	  </div>
	</div>


	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
	<script type="text/javascript" src="../js/validar_registro.js"></script>
</body>
</html>