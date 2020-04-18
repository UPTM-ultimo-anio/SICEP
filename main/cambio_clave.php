<?php 
	session_start();
	include ('../php/funciones.php');
	include ('../php/conexion.php');

	$usuario = $_SESSION ['usuario'];
	$enlace_actual = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

	$fecha = strtotime(date("Y-m-d"));

	registrarBitacora($usuario,$enlace_actual);

	$boton = $_POST['boton'];
	$claveActual = md5($_POST['claveActual']);
	$claveNueva = md5($_POST['claveNueva']);
	$claveNueva2 = md5($_POST['claveNueva2']);



	

	//echo $_SESSION ['id_cedu'];
	$result = mostrarUsuario($usuario);
	$row = $result->fetch_assoc();

	#echo $row['password'];



	//echo $clave;


$boton = $_POST['boton'];
	if($boton=="Enviar"){
		if ($row['password'] == $claveActual) {
		$sql="UPDATE usuario set password='$claveNueva' WHERE username = '".$_SESSION ['usuario']."' ";
		//echo $sql;
		mysqli_query($conexion,$sql);
		if($result>0){
			echo "<script>alert('Se cambio su clave con exito')</script>";
		//	echo $sql;
			echo "<script>window.location='cambio_clave.php'</script>";
		}else{

			echo "<script>alert('modificacion no exitosa')</script>";
			
			}
	}else{
		//echo $row['password'];

echo "<script>alert('Clave Incorrecta, Intente nuevamente')</script>";
	}

}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Cambio de Clave</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/main.css">
</head>
<body>
	<?php  include("menu.php");?>

<br>

<div class="container">
    <div class="row">

  <div class="col-xs-4">     

<div class="container text-center">
	 <h3>Cambio de clave<span class="extra-title muted"></span></h3>
   

  <form name="formName" class="border p-5 form" action="" method="POST" onsubmit='return validate_password()'>



	<div   id="eclaveActual"  style="color:#f00;"></div>
	<div>Clave actual: <input class="form-control" type="password"  name="claveActual"  placeholder="Ingrese su clave actual" value='' /></div>
	<div id="eclaveNueva" style="color:#f00;"></div>

	<div>Nueva clave: <input class="form-control" type="password" name="claveNueva" placeholder="Ingrese su nueva clave" /></div>



	<div>Repita la clave: <input  class="form-control" type="password" name="claveNueva2" placeholder="Confirme su clave " /></div>
  	
 <br>

  <input class="btn btn-primary " name="boton" id="boton" type="submit" value="Enviar" />

</div>
   </div>
     </div>
</form> 
</div>


<script type="text/javascript">
<!--
function validate_password()
{
	//Cogemos los valores actuales del formulario
	pasActual=document.formName.claveActual;
	pasNew1=document.formName.claveNueva;
	pasNew2=document.formName.claveNueva2;
	//Cogemos los id's para mostrar los posibles errores
	id_epassActual=document.getElementById("eclaveActual");
	id_epassNew=document.getElementById("eclaveNueva");

	//Patron para los numeros
	var patron1=new RegExp("[0-9]+");
	

	if(pasNew1.value==pasNew2.value && pasNew1.value.length>=8 && pasActual.value!="" && pasNew1.value.search(patron1)>=0 && pasNew1.value.search(patron2)){
		//Todo correcto!!!
		return true;
	}else{
		if(pasNew1.value.length<8)
			id_epassNew.innerHTML="La longitud mínima tiene que ser de 8 caracteres";
		else

		 if(pasNew1.value!=pasNew2.value)
			id_epassNew.innerHTML=" La contraseña no coincide";
		else 


		if(pasActual.value=="")
			id_epassActual.innerHTML="Indicar tu contraseña actual";
		else
			id_epassActual.innerHTML="";
		return false;
	}
}
</script>




	



	<script type="text/javascript" src="../js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/main.js"></script>
</body>
</html>