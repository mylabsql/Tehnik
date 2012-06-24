<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('equipment_m');
    $equ01 = new Equ01;

    switch ($action){
	case 'getcmbnama01':
		$result = $equ01->getcmbnama01($_REQUEST); 
		echo $result;  
			break; 
        case 'read':
            echo $equ01->read($_POST);
            break;
        case 'create':
            echo $equ01->create($_POST);
            break;
        case 'update':
            echo $equ01->update($_POST);
            break;
        case 'destroy':
            echo $equ01->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $equ01->edit($_POST['id'],$_POST); 
          break; 
    }
?>