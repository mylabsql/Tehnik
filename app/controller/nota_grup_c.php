<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('nota_grup_m');
    $listnotagrup = new Listnotagrup; 

    switch ($action){
	case 'getcmbnmtransgrup05':
		$result = $listnotagrup->getcmbnmtransgrup05($_REQUEST); 
		echo $result;  
			break;
	case 'getcmbEventgrup05':
		$result = $listnotagrup->getcmbEventgrup05($_REQUEST); 
		echo $result;  
			break; 
	case 'getcmbGrup05':
		$result = $listnotagrup->getcmbGrup05($_REQUEST); 
		echo $result;  
			break; 
        case 'getnotagrup05':
            echo $listnotagrup->getnotagrup05($_POST['cmbbulan05'],$_POST['usr_id'],$_POST);
            break;
        case 'getListgrup05':
        	echo $listnotagrup->getListgrup05($_POST['nota_id'],$_POST); 
        	break; 
        case 'getListgrup205':
        	echo $listnotagrup->getListgrup205($_POST['nota_id'],$_POST); 
        	break; 
        case 'create':
            echo $listnotagrup->create($_POST);
            break;
        case 'update':
            echo $listnotagrup->update($_POST);
            break;
        case 'destroy':
            echo $listnotagrup->destroy($_POST['data']);
            break;
        case 'lock':
            echo $listnotagrup->lock($_POST['data']);
            break;  	
        case 'edit':
          echo $listnotagrup->edit($_POST['id'],$_POST); 
          break; 
	
				

    }
?>