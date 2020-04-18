<?php 
	require '../php/fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('../img/gobernacion2.png', 80, 10, 140);
			$this->SetFont('Arial','B',15);
			$this->Ln(25);
			
		}
		

	}
	
	
?>