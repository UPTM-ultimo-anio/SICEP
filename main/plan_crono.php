<?php 
	include '../php/fpdf/fpdf.php';
	
	class PDF extends FPDF
	{
		function Header()
		{
			$this->Image('../img/LOGOMPPS.jpg', 15, 7, 60);
			$this->Image('../img/gobernacion2.png', 110, 14, 80);
			$this->Cell(20);
			$this->SetFont('Arial','B',10);
			$this->Ln(25);
		}
		
		function Footer()
		{
			$this->SetY(-25);
			$this->SetFont('Arial','I', 8);
			$this->Cell(0,0,'Salud Socialista Sin Fronteras',0,1,'C');
			$this->Cell(0,5,utf8_decode('"Aquí no se rinde nadie, aquí no se cansa nadie"...'),0,1,'C');
			$this->SetX(-290);
			$this->MultiCell(0,0,utf8_decode('Av. Urdaneta, Frente al Aeropuerto Alberto Carnevali Mérida. '),0,'C');
			$this->SetX(-187);
			$this->SetFont('Arial','B', 8);
			$this->MultiCell(0,0,utf8_decode(' Central Telefónica:'),0,'C');
			$this->SetX(79);
			$this->SetFont('Arial','I', 8);
			$this->MultiCell(0,0,utf8_decode(' 0274-2635289/2639941'),0,'C');
			$this->SetX(124);
			$this->SetFont('Arial','B', 8);
			$this->MultiCell(0,0,utf8_decode(' Extensión:'),0,'C');
			$this->SetX(143);
			$this->SetFont('Arial','I', 8);
			$this->MultiCell(0,0,utf8_decode(' 134'),0,'C');
			$this->SetX(0);
			$this->SetFont('Arial','B', 8);
			$this->MultiCell(0,5,utf8_decode(' e-mail:corposaludmerida@hotmail.com / Rif: G-20000819-9'),0,'C');
						
		}

	}
	
	
?>