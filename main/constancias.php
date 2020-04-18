<?php 	
	include ('plan_crono.php');
	include ('../php/conexion.php');
	include ('../php/funciones.php');
	
	$x1=$_GET['ced_exp'];
	
	ini_set('date.timezone', 'America/Caracas');
	
	$fecha=date('d/m/Y');
	
	$result = mostrarExpediente($x1);
	$otro_mas = mostrarExpediente($x1);
	#echo $cargo;
	
	//$director="SELECT * FROM expediente INNER JOIN cargo_ubic ON expediente.ced_exp=cargo_ubic.ced_exp WHERE cargo_ubic.cod_car=10 AND cargo_ubic.fec_ret_car='Actual'";
	
	//$resuldire = $conexion->query($director);
	//
	$expediente = $result->fetch_assoc();
	
	
	$pdf = new PDF('P');
	
	$pdf->AddPage();
	
	$pdf->SetFont('Arial','B',11);
	$pdf->Cell(0,20,'CONSTANCIA',0,0,'C');
	$pdf->SetFont('Arial','',11);
	$pdf->SetXY(18,50);
	$pdf->MultiCell(170,5,utf8_decode('Quien   suscribe, DIRECTOR DE RECURSOS HUMANOS de esta Corporación de Salud del estado Mérida,  hace   constar por medio de la presente que  el(a) ciudadano(a) ' .$expediente['nom_fun'] .' '.$expediente['ape_fun'] .', titular de  la Cédula de Identidad No. ' .$expediente['ced_fun'] .' prestó servicios en esta Institución según la siguiente especificación:'),'C');
	$pdf->SetY(75);
	
	 while($row  = $otro_mas->fetch_assoc()) 
	  //while($row  = $resultado->fetch_assoc()) 
				  {
					$pdf->Cell(100,5,'',0,5);
					$pdf->SetX(18);
					$pdf->SetFont('Arial','I',12);
					//$pdf->SetFont('Arial','',12);
  					$pdf->MultiCell(170,5,utf8_decode(' ' .$row['nom_car'] .': (' .$row['est_car'] .') desde el ' .date('d-m-Y', strtotime($row['fec_car_ing'])).' hasta el '.$retVal = ($row['fec_ret_car'] == '0000-00-00') ? 'presente de hoy' : $row['fec_ret_car'].' en '.$row['nom_dep'].''));
				  };
				  $pdf->Cell(100,5,'',0,5);
				  $pdf->Cell(100,20,'',0,5);
	$pdf->SetX(18);
	$pdf->MultiCell(170,5,utf8_decode('Constancia que se expide,  a solicitud de parte interesada, en Mérida.'));			  
	$pdf->SetFont('Arial','I',11);
	$pdf->SetX(18);
	$pdf->Cell(100,5,$fecha,0,1);
	$pdf->SetFont('Arial','B',11);
	$pdf->SetX(18);
	//$pdf->Ln();
	
	$pdf->Cell(100,5,'Nota: Valido por tres (3) meses.',0,1);
	$pdf->SetFont('Arial','I',11);
	$pdf->Cell(100,20,'',0,5);

	$pdf->SetX(55);	
	$pdf->MultiCell(100,5,utf8_decode('LCDO. MIGUEL ANGEL  RINCON FIGUEROA
Director (E) de Administración de Personal
Corporación de Salud del Estado Bolivariano de  Mérida
Según Decreto del Ejecutivo Regional N° 262, de fecha 26/06/2015
'),'0','C');
	

		$pdf->Output();
	
?>