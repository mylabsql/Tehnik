<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('nota_m');
    $listnota = new Listnota; 

    switch ($action){
	case 'getcmbnmtrans':
		$result = $listnota->getcmbnmtrans($_REQUEST); 
		echo $result;  
			break;
	case 'getcmbevent02':
		$result = $listnota->getcmbevent02($_REQUEST); 
		echo $result;  
			break; 
	case 'getcmbequ02':
		$result = $listnota->getcmbequ02($_REQUEST); 
		echo $result;  
			break; 
        case 'getnota02':
            echo $listnota->getnota02($_POST['cmbbulan'],$_POST['usr_id'],$_POST);
            break;
        case 'getListequ02':
        	echo $listnota->getListequ02($_POST['nota_id'],/*$_POST['usr_id'],*/$_POST); 
        	break; 
        case 'getListeq02':
        	echo $listnota->getListeq02($_POST['nota_id'],/*$_POST['usr_id'],*/$_POST); 
        	break; 
        case 'create':
            echo $listnota->create($_POST);
            break;
        case 'update':
            echo $listnota->update($_POST);
            break;
        case 'destroy':
            echo $listnota->destroy($_POST['data']);
            break;
        case 'lock':
            echo $listnota->lock($_POST['data']);
            break;  	
        case 'edit':
          echo $listnota->edit($_POST['id'],$_POST); 
          break; 
	
				

    }
?>