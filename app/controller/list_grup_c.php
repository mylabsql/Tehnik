<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('list_grup_m');
    $list_grup07 = new list_grup07;

    switch ($action){
	case 'getcmbgrup07':
		$result = $list_grup07->getcmbgrup07($_REQUEST); 
		echo $result;  
			break; 
        case 'read':
            echo $list_grup07->read($_POST['grupid'], $_REQUEST);
            break;
    }
?>