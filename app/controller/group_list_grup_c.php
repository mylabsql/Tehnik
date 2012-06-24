<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('group_list_grup_m');
    $group_list_grup08 = new group_list_grup08;

    switch ($action){
	case 'getcmbgrup08':
		$result = $group_list_grup08->getcmbgrup08($_REQUEST); 
		echo $result;  
			break; 
        case 'read':
            echo $group_list_grup08->read($_POST['grupid08'], $_REQUEST);
            break;
    }
?>