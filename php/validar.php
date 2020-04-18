<?php
 	include('conexion.php');

   // $salida = "";

    session_start();

    //echo "Estas en la pagina".$_SESSION['variable'];
    //include("../main/admin/consulta_exp_2.php");
    $salida = "";
    $query = "SELECT * FROM funcionario";

    //echo $query;
    if(isset($_POST['consulta'])){
    $q = $conexion-> real_escape_string($_POST['consulta']);
       $query = "SELECT * FROM funcionario WHERE ced_fun = $q";
       $resultado = $conexion->query($query);
    }

   
    if (strlen($q)>=6) {
      if ($resultado->num_rows>0) {
            $respuesta = array('codigo' => 2, 'mensaje' => '<div id="Success" style="margin:3px;">Código incorrecto</div>');
             
            }else{ 
              $respuesta = array('codigo' => 1, 'mensaje' => '<div id="Error" style="margin:3px;">Código correcto</div>');
            }        

    }else{
        $respuesta = array('codigo' => 0, 'mensaje' => '<div id="Success" style="margin:3px;">Código incorrecto</div>');
        
    }


    
   echo json_encode($respuesta);

    $conexion->close();

?>