<?php
require ABSPATH .'includes/fpdf/fpdf.php'; 

  $pdf=new FPDF();
  $pdf->AddPage();
  $pdf->SetFont('Arial','B',16);
  $pdf->Cell(75,10,'List Sistem');
  $pdf->Ln(); 
  
  $pdf->SetFont('Helvetica', 'B', 10);
  $pdf->Cell(75,7,'Sistem',1);
  $pdf->Cell(100,7,'Keterangan',1); 
    $pdf->Ln(); 
  
  $pdf->SetFont('Helvetica', '', 10);
     
  while ($row=$rs->FetchNextObject()) {
    $pdf->Cell(75,7,$row->SISTEM,1); 
    $pdf->Cell(100,7,$row->KETERANGAN,1); 
    $pdf->Ln();    
  }
  
  $pdf->Output();
?>