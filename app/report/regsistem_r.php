<?php
   $handler->loadModel("regsistem_m"); 
  $regsistem = new Sistem;
  
  $rs = $regsistem->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'sistem/'.$include_file;
  
  
?>