<?php 

	include 'conexion.php';
	date_default_timezone_set("America/Caracas");
	session_start();
	$result = '';

	function iniciarSesion($usuario, $password){
		global $conexion;
		$sql = "SELECT * FROM usuario WHERE username = '{$usuario}' AND password = '{$password}'";
		return $conexion->query($sql);
	}

	function listadoUsuarios()
	{
		global $conexion;
		$sql = "SELECT * FROM usuario";
		return $conexion->query($sql);
	}

	function actualizarUsuarios($username,$nombre,$apellido,$status)
	{
		global $conexion;
		$sql="UPDATE usuario set nombre='$nombre', apellido='$apellido', status='$status' WHERE username = '$username'";
		return $conexion->query($sql);
	}

	function usuarioRepetido($usuarios){
		global $conexion;
		$sql="SELECT * from usuario where username='{$usuarios}'";
		$result = $conexion->query($sql);

		if(mysqli_num_rows($result) > 0){
			return 1;
		}else {
			return 0;
		}
	}

	function registrarUsuario($username,$nombre,$apellido,$password,$id_tipo,$status)
	{
		global $conexion;
		$sql = "INSERT INTO usuario VALUES ('{$username}','{$nombre}','{$apellido}','{$id_tipo}','{$status}',md5('{$password}'))";
		echo $sql;
		return $conexion->query($sql);
	}

	function mostrarUsuario($username)
	{
		global $conexion;
		$sql = "SELECT * FROM usuario WHERE username='{$username}'";
		return $conexion->query($sql);
	}
	

	//Funciones Para el Funcionario

	function registrarFuncionario($ced_fun,$nom_fun,$ape_fun,$lug_nac_fun,$pai_fun,$fec_nac_fun,$cod_area,$tel_exp,$cor_fun,$est_civ_exp,$dir_exp,$cond_exp,$estatus_car,$f_ing_exp,$ciu_exp,$est_fun,$tipo_telefono,$cod_car,$cod_dep,$fec_ret_car = ''){
		global $conexion;

		#$sql = "INSERT INTO funcionario VALUES ('{$ced_fun}','{$nom_fun}','{$ape_fun}','{$lug_nac_fun}','{$pai_fun}','{$fec_nac_fun}','{$cor_fun}','{$est_civ_exp}','{$dir_exp}','{$ciu_exp}','{$est_fun}')";
		
		try {
			// Tabla funcionario
			$sql = "INSERT INTO funcionario VALUES ('{$ced_fun}','{$nom_fun}','{$ape_fun}','{$lug_nac_fun}','{$pai_fun}','{$fec_nac_fun}','{$cor_fun}','{$est_civ_exp}','{$dir_exp}','{$ciu_exp}','{$est_fun}','{$cond_exp}','{$f_ing_exp}','')";
			#return $sql;
			$result = $conexion->prepare($sql);	
			$result->execute();
			
			// Tabla telefono
			if (strlen($cod_area) > 0 && strlen($tel_exp) > 0) {
				$sql = "INSERT INTO telefono_funcionario VALUES ('{$ced_fun}','{$cod_area}', '{$tel_exp}','{$tipo_telefono}')";
				$result = $conexion->prepare($sql);
				#return $result;
				$result->execute();
			}
			
			// Tabla Expediente
			$sql = "INSERT INTO expediente VALUES ('{$ced_fun}','{$cod_car}', '{$cod_dep}','{$f_ing_exp}','','{$estatus_car}')";
			$result = $conexion->prepare($sql);
			#return $result;
			$result->execute();

			return $conexion->commit();
			} catch (Exception $e) {
				// si ocurre un error hacemos rollback para anular todos los insert
				$conexion->rollback();
				return $e->getMessage();
			} 	
	}

	function buscaRepetido($cedula){
		global $conexion;
		$sql="SELECT * from funcionario where ced_fun='$cedula'";
		$result=mysqli_query($conexion,$sql);

		if(mysqli_num_rows($result) > 0){
			return 1;
		}else {
			return 0;
		}
	}

	function cantidadFuncionario()
	{
		global $conexion;
		$sql = "SELECT * FROM funcionario ORDER By ced_fun ";
		$destacado = $conexion->query($sql);
    	return $destacado->num_rows;  
	}

	function buscarFuncionario($result)
	{
		global $conexion;
		$q = $conexion->real_escape_string($result);
        $sql = "SELECT * FROM funcionario WHERE ced_fun LIKE '%$q%' OR nom_fun LIKE '%$q%' OR ape_fun LIKE '%$q%'";

        return $conexion->query($sql);
	}

	function listadoFuncionario()
	{
		global $conexion;
		$sql = "SELECT * FROM funcionario LIMIT 10";
		return $conexion->query($sql);
	}

	function funcionario($cedula)
	{
		global $conexion;
		$sql = "SELECT * FROM funcionario WHERE ced_fun = '{$cedula}'";
		return $conexion->query($sql);
		
	}

	function mostrarFuncionario($cedula)
	{
		global $conexion;
		$sql = "SELECT * FROM funcionario, telefono_funcionario WHERE funcionario.ced_fun='{$cedula}' AND telefono_funcionario.ced_fun = funcionario.ced_fun";
		#echo $sql;
		return $conexion->query($sql);
	}

	function expedienteFuncionarioMostrar($cedula)
	{
		global $conexion;
		$sql = "SELECT * FROM funcionario INNER JOIN expediente ON funcionario.ced_fun=expediente.ced_fun INNER JOIN cargos ON cargos.cod_car=expediente.cod_car  INNER JOIN departamentos ON departamentos.cod_dep=expediente.cod_dep WHERE funcionario.ced_fun='{$cedula}' AND expediente.fec_ret_car='0000-00-00' ";
		//echo $sql;
		return $conexion->query($sql);

	}

	function mostrarDatosdeTrabajador($cedula)
	{
		global $conexion;
		$sql = "SELECT * FROM funcionario INNER JOIN expediente ON funcionario.ced_fun=expediente.ced_fun INNER JOIN cargo ON cargo.cod_car=expediente.cod_car  INNER JOIN departamento ON departamento.cod_dep=expediente.cod_dep WHERE funcionario.ced_fun='{$cedula}' ";
		return $conexion->query($sql);

	}

	function mostrarParaActualizar($cedula)
	{
		global $conexion;
		$sql = "SELECT * FROM funcionario WHERE ced_fun='{$cedula}'";
		#return $sql;
		return $conexion->query($sql);
	}

	function actualizarFuncionario($ced_fun,$nom_fun,$ape_fun,$lug_nac_fun,$pai_fun,$fec_nac_fun,$cor_fun,$est_civ_exp,$dir_exp,$cond_exp,$ciu_exp,$est_fun)
	{
		global $conexion;
		$sql="UPDATE funcionario SET ced_fun='{$ced_fun}', nom_fun='{$nom_fun}', ape_fun='{$ape_fun}', ciu_exp='{$ciu_exp}', pai_fun='{$pai_fun}', lug_nac_fun='{$lug_nac_fun}', fec_nac_fun='{$fec_nac_fun}', dir_exp='{$dir_exp}', est_civ_exp='{$est_civ_exp}', cond_exp='{$cond_exp}', est_fun='{$est_fun}', cor_fun='{$cor_fun}' WHERE ced_fun='{$ced_fun}'";
		return $conexion->query($sql);
		#return $sql;

	}


	function registrarBitacora($usuario,$enlace_actual)
	{
		global $conexion;
		$sql = "INSERT INTO bitacora_ruta VALUES (now(),'{$usuario}','{$enlace_actual}')";
		return $conexion->query($sql);
	}

	function consultaBitacora($fecha1,$fecha2,$usuario)
	{
		global $conexion;
		$sql = "SELECT * FROM bitacora_ruta WHERE fecha_ruta between '".$fecha1." 00:00:00' AND '".$fecha2." 23:59:59'";
		#echo $sql;
		return $conexion->query($sql);
	}
	

	function registrarFamiliar($ced_fun,$ced_fam,$nom_fam,$ape_fam,$fec_fam,$tip_par)
	{
		global $conexion;
		$sql = "INSERT INTO familiares VALUES ('{$ced_fun}','{$ced_fam}','{$nom_fam}','{$ape_fam}','{$fec_fam}','{$tip_par}')";
		#return $sql;
		return $conexion->query($sql);
	}

	function consultarFamiliar($ced_fun)
	{
		global $conexion;
		$sql = "SELECT * FROM familiares INNER JOIN parentesco ON parentesco.tip_par=familiares.tip_par INNER JOIN funcionario ON funcionario.ced_fun=familiares.ced_fun WHERE familiares.ced_fun = '{$ced_fun}'";
		return $conexion->query($sql);
	}

	function mostrarParentesco()
	{
		global $conexion;
		$sql = "SELECT * FROM parentesco";
		return $conexion->query($sql);
	}

	function mostrarActualizarFamiliar($ced_fun,$ced_fam)
	{
		global $conexion;
		$sql="SELECT * FROM familiares WHERE ced_fun='{$ced_fun}' and ced_fam = '{$ced_fam}'";
		#return $sql;
		return $conexion->query($sql);
	}

	function actualizarFamiliar($new_ced,$nom_fam,$ape_fam,$fec_fam,$tip_par,$ced_fun,$ced_fam)
	{
		global $conexion;
		$sql="update familiares set ced_fam='{$new_ced}', nom_fam='{$nom_fam}', ape_fam='{$ape_fam}', fec_fam='{$fec_fam}', tip_par='{$tip_par}' WHERE ced_fun = '$ced_fun' and ced_fam = '$ced_fam'";
		#return $sql;
		return $conexion->query($sql);
	}

	function mostrarCargos()
	{
		global $conexion;
		$sql = "SELECT * FROM cargos ORDER BY nom_car";
		return $conexion->query($sql);
	}

	function mostrarDepartamento()
	{
		global $conexion;
		$sql = "SELECT * FROM departamentos ORDER BY nom_dep";
		return $conexion->query($sql);
	}
 	
 	function mostrarExpediente($cedula)
 	{
 		global $conexion;
		$sql = "SELECT * FROM expediente INNER JOIN departamentos ON departamentos.cod_dep = expediente.cod_dep INNER JOIN cargos ON cargos.cod_car = expediente.cod_car INNER JOIN funcionario ON funcionario.ced_fun = expediente.ced_fun WHERE expediente.ced_fun = '{$cedula}' ORDER BY expediente.fec_car_ing";
		#return $sql;
		return $conexion->query($sql);
	}

 	function registrarCargosFuncionario($cod_car,$ced_fun,$cod_dep,$fec_car_ing,$fec_ret_car,$est_car)
 	{
 		global $conexion;
 		$sql = "INSERT INTO expediente VALUES ('{$ced_fun}','{$cod_car}','{$cod_dep}','{$fec_car_ing}','{$fec_ret_car}','{$est_car}')";
 		return $conexion->query($sql);
 	}

 	function mostrarCargosFuncionario($cedula,$fec_car_ing)
 	{
 		global $conexion;
 		$sql = "SELECT * FROM expediente WHERE ced_fun = '{$cedula}' AND fec_car_ing = '{$fec_car_ing}'";
 		return $conexion->query($sql);
 	}

 	function actualizarCargosFuncionario($cod_car,$cod_dep,$fec_car_ing_new,$fec_ret_car,$est_car,$ced_fun,$fec_car_ing)
 	{
 		global $conexion;
 		$sql = "UPDATE expediente set cod_car = '{$cod_car}', cod_dep = '{$cod_dep}',fec_car_ing = '{$fec_car_ing_new}', fec_ret_car = '{$fec_ret_car}', est_car = '{$est_car}' WHERE ced_fun = '{$ced_fun}', '{$fec_car_ing}'";
 		return $conexion->query($sql);
 	}

 	function buscarSoliFuncionario($cedula)
 	{
 		global $conexion;
 		$sql="SELECT * FROM funcionario INNER JOIN expediente ON funcionario.ced_fun=expediente.ced_fun INNER JOIN departamentos ON departamentos.cod_dep=expediente.cod_dep INNER JOIN cargos on cargos.cod_car=expediente.cod_car WHERE expediente.ced_fun='$cedula' AND expediente.fec_ret_car='0000-00-00'";
 		#echo $sql;
		return $conexion->query($sql);
 	}

 	function DiferenciaDeDia($fecha_inicio,$fecha_fin)
 	{
		$trans = new DateTime($fecha_inicio);
    	$currido = new DateTime($fecha_fin);
    	//$cumpliendo = strtotime($f_ingresada);
    
    	$dias = $currido->diff($trans);
    	$tiempo= $dias->days;
    	return $tiempo;
	}

	function TiempoTrabajando($cedula)
	{
		global $conexion;
		$sql="SELECT * from funcionario where ced_fun='$cedula'";
		$result=$conexion->query($sql);
		$row=$result->fetch_assoc();
		list($Y,$m,$d) = explode("-",$row['fec_ing_fun']);
	    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
	}

	function solicitarVacaciones($ced_fun,$fec_sol_vac,$per_vac,$tip_vac,$fec_ini_vac,$fec_fin_vac)
	{
		global $conexion;
		$sql = "INSERT INTO vacaciones VALUES('{$ced_fun}','{$fec_sol_vac}','{$fec_ini_vac}','{$fec_fin_vac}','{$per_vac}','{$tip_vac}')";
		return $conexion->query($sql);
	}

	function mostrarSolicitud($fec_sol)
	{
		global $conexion;
		$sql="SELECT * FROM vacaciones INNER JOIN funcionario ON funcionario.ced_fun=vacaciones.ced_fun INNER JOIN expediente ON funcionario.ced_fun=expediente.ced_fun INNER JOIN departamentos ON departamentos.cod_dep=expediente.cod_dep INNER JOIN cargos on cargos.cod_car=expediente.cod_car WHERE vacaciones.fec_vac='{$fec_sol}' and expediente.fec_ret_car='0000-00-00' ";
		return $conexion->query($sql);
	}

?>