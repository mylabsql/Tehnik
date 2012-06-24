<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('nota_grup_detail_m');
    $grupdetailnota = new Grupdetailnota; 

    switch ($action){
	case 'getcmbnota06':
		$result = $grupdetailnota->getcmbnota06($_POST['start'], $_POST['limit'], $_REQUEST); 
		echo $result;  
			break;
        case 'outlistnota06':
            echo $grupdetailnota->outlistnota06($_POST['cmbNota06'],/*$_POST['usr_id'],*/$_POST);
            break;
	case 'inlistnota06':
            echo $grupdetailnota->inlistnota06($_POST['cmbNota06'],/*$_POST['usr_id'],*/$_POST);
            break;
        case 'cekSN06':
        	echo $grupdetailnota->cekSN06($_POST['textSN06'],/*$_POST['usr_id'],*/$_REQUEST); 
        	break;
        case 'statusSN06':
	        echo $grupdetailnota->statusSN06($_POST['textSN06']);
        	break; 
        case 'dissasembly06':
        	echo $grupdetailnota->dissasembly06($_POST['textSN06'],$_POST['nota_id'],$_POST['usr_id'],$_POST['group']); 
        	break; 
        case 'assembly06':
        	echo $grupdetailnota->assembly06($_POST['textSN06'],$_POST['nota_id'],$_POST['usr_id'],$_POST['group']); 
        	break; 
	
				

    }
?>