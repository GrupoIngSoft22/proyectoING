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
    $this->SetFont('Arial','B',11);
    // Movernos a la derecha
    $this->Cell(75);
    // Título
    $this->Cell(120,10,'INFORME FORMULARIOS ADOPCIONES EFECTIVAS',1,0,'C');
    // Salto de línea
    $this->Ln(60);

    $this->Cell(25, 10, 'ID Form.', 1, 0, 'c', 0);
    $this->Cell(25, 10, 'ID Usuario', 1, 0, 'c', 0);
    $this->Cell(25, 10, 'ID Mascota', 1, 0, 'c', 0);
    $this->Cell(25, 10, 'Estado Sol.', 1, 0, 'c', 0);
    $this->Cell(65, 10, 'Justificacion', 1, 0, 'c', 0);
    $this->Cell(28, 10, 'Fecha', 1, 1, 'c', 0);


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
$consulta ="Select * FROM formulario_adop";
$resultado =$mysqli ->query($consulta);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
//for($i=1;$i<=10;$i++)
  //  $pdf->Cell(0,10,'Cliente '.$i,0,1);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(25, 10, $row['id_formulario_ad'], 1, 0, 'c', 0);
    $pdf->Cell(25, 10, $row['id_persona'], 1, 0, 'c', 0);
    $pdf->Cell(25, 10, $row['id_mascota'], 1, 0, 'c', 0);
    $pdf->Cell(25, 10, $row['estado_solicitud'], 1, 0, 'c', 0);
    $pdf->Cell(65, 10, $row['justificacion'], 1, 0, 'c', 0);
    $pdf->Cell(28, 10, $row['fecha'], 1, 1, 'c', 0);
}
    $pdf->Output();
?>