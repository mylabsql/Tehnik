<?php
   $handler->loadModel("regevent_m"); 
  $regevent = new Event;
  
  $rs = $regevent->doReport($_POST); 
  
  $include_file = ($_POST['mode']=='pdf')?'pdf.php':'xls.php'; 
  
  include 'event/'.$include_file;
  
  
?>