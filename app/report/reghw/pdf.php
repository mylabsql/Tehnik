<?php
require ABSPATH .'includes/fpdf/fpdf.php'; 

  $pdf=new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(40,10,'Hardware List');
  $pdf->Ln(); 
  
  $pdf->SetFont('Helvetica', 'B', 10);
  $pdf->Cell(10,7,'Tipe',1); 
  $pdf->Cell(30,7,'Sn',1); 
  $pdf->Cell(50,7,'Nama',1); 
  $pdf->Cell(20,7,'Alamat',1); 
  $pdf->Cell(30,7,'Status',1); 
  $pdf->Cell(20,7,'Func',1); 
  $pdf->Ln(); 
  
  $pdf->SetFont('Helvetica', '', 10);
     
  while ($row=$rs->FetchNextObject()) {
    $pdf->Cell(10,7,$row->TIPE,1); 
    $pdf->Cell(30,7,$row->SN,1); 
    $pdf->Cell(50,7,$row->NAMA,1); 
    $pdf->Cell(20,7,$row->ALAMAT,1); 
    $pdf->Cell(30,7,$row->STATUS,1); 
    $pdf->Cell(20,7,$row->FUNC,1); 
    $pdf->Ln();    
  }
  
  $pdf->Output();
?>