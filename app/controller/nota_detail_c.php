<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('nota_detail_m');
    $detailnota = new Detailnota; 

    switch ($action){
	case 'getcmbnota04':
		$result = $detailnota->getcmbnota04($_POST['start'], $_POST['limit'], $_REQUEST); 
		echo $result;  
			break;
        case 'outlistnota04':
            echo $detailnota->outlistnota04($_POST['cmbNota04'],/*$_POST['usr_id'],*/$_POST);
            break;
	case 'inlistnota04':
            echo $detailnota->inlistnota04($_POST['cmbNota04'],/*$_POST['usr_id'],*/$_POST);
            break;
        case 'cekSN':
        	echo $detailnota->cekSN($_POST['textSN'],/*$_POST['usr_id'],*/$_REQUEST); 
        	break;
        case 'statusSN':
	        echo $detailnota->statusSN($_POST['textSN']);
        	break; 
        case 'masukSN':
        	echo $detailnota->masukSN($_POST['textSN'],$_POST['nota_id'],$_POST['usr_id']); 
        	break; 
        case 'keluarSN':
        	echo $detailnota->keluarSN($_POST['textSN'],$_POST['nota_id'],$_POST['usr_id']); 
        	break; 
	
				

    }
?>