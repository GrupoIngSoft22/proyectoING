<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('petAdoption2.jpg',10,8,70);
    // Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(110,10,'INFORME MASCOTAS PET ADOPTION',1,0,'C');
    // Salto de línea
    $this->Ln(60);

    $this->Cell(22, 10, 'ID Mas.', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Tipo', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Edad', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Genero', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Raza', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Estado', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Nombre', 1, 0, 'c', 0);
    $this->Cell(32, 10, 'ID Persona', 1, 1, 'c', 0);


}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'PET ADOPTION pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cn.php'; 
$consulta ="Select * FROM mascota";
$resultado =$mysqli ->query($consulta);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//for($i=1;$i<=10;$i++)
  //  $pdf->Cell(0,10,'Cliente '.$i,0,1);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(22, 10, $row['id_mascota'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['tipo'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['edad'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['genero'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['raza'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['estad'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['nombre'], 1, 0, 'c', 0);
    $pdf->Cell(32, 10, $row['id_persona'], 1, 1, 'c', 0);
}
    $pdf->Output();
?>