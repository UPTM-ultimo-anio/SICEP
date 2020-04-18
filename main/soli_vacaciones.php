<?php 	
	include ('plantilla.php');
	include ('../php/conexion.php');
	include ('../php/funciones.php');
	$fec_sol_vac=$_GET['fec_sol_vac'];
	
	//$jefe="SELECT * FROM expediente INNER JOIN cargo_ubic ON expediente.ced_exp=cargo_ubic.ced_exp WHERE cargo_ubic.cod_car=9 AND cargo_ubic.fec_ret_car='Actual'";
	$result = mostrarSolicitud($fec_sol_vac);
	//$director="SELECT * FROM expediente INNER JOIN cargo_ubic ON expediente.ced_exp=cargo_ubic.ced_exp WHERE cargo_ubic.cod_car=8 AND cargo_ubic.fec_ret_car='Actual'";
	
	//$resuljefe = $conexion->query($jefe);
	//$resuldire = $conexion->query($director);
	
	
	$row = $result->fetch_assoc();
	
	$pdf = new PDF('L');
	$pdf->AddPage();
	$pdf->SetFont('Arial','',12);
	$pdf->SetX(22);
	$pdf->Cell(250,15,utf8_decode('GOBIERNO DEL ESTADO BOLIVARION DE MÉRIDA CORPORACIÓN DE SALUD'),1,1,'C');
	$pdf->SetX(22);

	$pdf->Cell(250,15,'SOLICITUD DE VACACIONES',1,1,'C');
	$pdf->SetFont('Arial','',10);
	$pdf->SetX(22);
	$pdf->Cell(125,15,utf8_decode('VACACIONES:' .$row['tip_vac']) ,1,0,'C');
	$pdf->Cell(125,15,utf8_decode('FECHA DE PREPARACIÓN:' .$row['fec_vac']),1,1,'C');
	$pdf->SetX(22);
	$pdf->Cell(150,15,utf8_decode('APELLIDOS Y NOMBRES DEL EMPLEADO:' .$row['nom_fun'] .' '.$row['ape_fun']),1,0,'C');
	$pdf->Cell(100,15,'CEDULA DE IDENTIDAD:' .$row['ced_fun'],1,1,'C');
	$pdf->SetX(22);
	$pdf->Cell(115,15,utf8_decode('DENOMINACIÓN DEL CARGO:' .$row['nom_car']),1,0,'C');
	$pdf->Cell(135,15,utf8_decode('UBICACIÓN, SITIO DE TRABAJO:' .$row['nom_dep']),1,1,'C');
	$pdf->SetX(22);
	$pdf->SetFont('Arial','',10);
	$pdf->MultiCell(65,20,'FECHA DE INGRESO:' .$row['fec_ing_exp'],1,'C');
	$pdf->SetXY(87,110);
	$pdf->MultiCell(65,20,'PER. CORRES.:  ' .$row['per_vac'],1,'C');
	$pdf->SetXY(152,110);
	$pdf->MultiCell(60,20,'DESDE:' .$row['fec_ini_vac'],1);
	$pdf->SetXY(212,110);
	$pdf->MultiCell(60,20,'HASTA:' .$row['fec_fin_vac'],1,1);
	$pdf->SetX(22);
	$pdf->MultiCell(250,15,'                                                                                                                                   Firma del Empleado__________________________________ ',1,1);
	$pdf->SetX(22);
	//$rowdir= $resuldire->fetch_assoc();
	$pdf->MultiCell(180,15,utf8_decode('DIRECTOR GEN. DE LA CORP. DE SALUD: DR. JOSE GREGORIO MORALES'),1,'L');
	$pdf->SetXY(202,145);
	$pdf->MultiCell(70,15,('FIRMA:'),1);
	$pdf->SetX(22);
	
	//$rowjef= $resuljefe->fetch_assoc();
	$pdf->MultiCell(180,15,utf8_decode('DIREC. DE GEST. Y TALEN. HUM DE LA CORP.: ABG. ELIMAR TERESA QUINTERO MOLINA ') ,1,'L');
	$pdf->SetXY(202,160);
	$pdf->MultiCell(70,15,('FIRMA:'),1);
	

	$pdf->Output();
	
?>