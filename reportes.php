<?php
//require('../../fpdf/fpdf.php');
include('plan_crono.php');
include('../php/conexion.php');
include ('../php/funciones.php');

$result = listadoFuncionario();

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf -> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(190,10,utf8_decode('Personal de Corposalud del estado Mérida'),0,2,'C',0);
$pdf->SetFont('Arial','',12);
$pdf->Cell(30,10,'Cedula', 1, 0, 'C', 0);
$pdf->Cell(90,10,'Nombres y Apellidos', 1, 0, 'C', 0);
$pdf->Cell(50,10,'Fecha de ingreso', 1, 0, 'C', 0);
$pdf->Cell(20,10,'Estados', 1, 1, 'C', 0);
while($row = $result->fetch_assoc()){
	$pdf->Cell(30,10,$row['ced_fun'], 1, 0, 'C', 0);
	$pdf->Cell(90,10,utf8_decode($row['nom_fun'].' '.$row['ciu_exp']), 1, 0, 'C', 0);
	$pdf->Cell(50,10,date('d-m-Y',strtotime($row['fec_ing_exp'])), 1, 0, 'C', 0);
	$pdf->Cell(20,10,$row['cond_exp'], 1, 1, 'C', 0);
}

$pdf->Output();
?>