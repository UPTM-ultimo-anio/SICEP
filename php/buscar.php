<?php
 	include('conexion.php');
    include ('funciones.php');



   // $salida = "";

    session_start();

    //echo "Estas en la pagina".$_SESSION['variable'];
    //include("../main/admin/consulta_exp_2.php");

    $descata = cantidadFuncionario();
    
    if (isset($_POST['consulta'])) {

        $resultado = buscarFuncionario($_POST['consulta']);
    }

    //echo $paginada;

            if ($resultado->num_rows>0) {
            	$salida.="<div class='table-responsive sm'>
                            <table  class='table '>
                    			<thead class='thead-dark'>
                    				<tr >
                    					<th scope='col'>Estado</th>
                    					<th scope='col'>Cedula</th>
                    					<th scope='col'>Nombre</th>
                    					<th scope='col'>Apellido</th>
                                        <th scope='col'>Herramientas</th>
                    				</tr>
                    			</thead>
                    	<tbody>";

            	while ($fila = $resultado->fetch_assoc()) {
            		$salida.="<tr>
            					<td>".$fila['cond_exp']."</td>
            					<td>".$fila['ced_fun']."</td>
            					<td>".$fila['nom_fun']."</td>
            					<td>".$fila['ape_fun']."</td>
                                <td><a  name='consultado' href=consulta.php?codigo=".$fila["ced_fun"]."><img src='../img/ver.png' width='25' alt='Edicion' title='Consultar el expediente de ".$fila["nom_fun"]."'>
                                </td>
            				</tr>";
                        
            	}
            	$salida.="</tbody></table></div>";
                            


            }else{
            	$salida.="";
            }

            echo "<div class='container '>
                    <h5 class='bg-primary text-center pad-basic no-btm'>Numero total de registro: ".$descata." del personal de Corposalud</h5>
                   </div> ";

            echo $salida;

            $conexion->close();

?>