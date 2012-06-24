<?php
   $handler->loadModel("reghw_m"); 
  $reghw = new Hwd;
  
  $rs = $reghw->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'reghw/'.$include_file;
  
  
?>