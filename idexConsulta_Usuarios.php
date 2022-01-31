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
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Cell(80);
    // Título
    $this->Cell(110,10,'INFORME USUARIOS PET ADOPTION',1,0,'C');
    // Salto de línea
    $this->Ln(60);

    $this->Cell(15, 10, 'ID User.', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Cedula', 1, 0, 'c', 0);
    $this->Cell(28, 10, 'Nombres', 1, 0, 'c', 0);
    $this->Cell(25, 10, 'Apellidos', 1, 0, 'c', 0);
    $this->Cell(30, 10, 'Correo', 1, 0, 'c', 0);
    $this->Cell(22, 10, 'Direccion', 1, 0, 'c', 0);
    $this->Cell(19, 10, 'Ciudad', 1, 0, 'c', 0);
    $this->Cell(15, 10, 'ID Rol', 1, 0, 'c', 0);
    $this->Cell(15, 10, 'Pass', 1, 1, 'c', 0);


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
$consulta ="Select * FROM usuario";
$resultado =$mysqli ->query($consulta);

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',9);
//for($i=1;$i<=10;$i++)
  //  $pdf->Cell(0,10,'Cliente '.$i,0,1);

while($row = $resultado->fetch_assoc()){
    $pdf->Cell(15, 10, $row['id'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['cedula'], 1, 0, 'c', 0);
    $pdf->Cell(28, 10, $row['nombres'], 1, 0, 'c', 0);
    $pdf->Cell(25, 10, $row['apellidos'], 1, 0, 'c', 0);
    $pdf->Cell(30, 10, $row['correo'], 1, 0, 'c', 0);
    $pdf->Cell(22, 10, $row['direccion'], 1, 0, 'c', 0);
    $pdf->Cell(19, 10, $row['cuidad'], 1, 0, 'c', 0);
    $pdf->Cell(15, 10, $row['id_rol'], 1, 0, 'c', 0);
    $pdf->Cell(15, 10, $row['pass'], 1, 1, 'c', 0);
}
    $pdf->Output();
?>