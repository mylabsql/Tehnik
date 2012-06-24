<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('event_m');
    $event = new Event03;

    switch ($action){
        case 'read':
            echo $event->read($_POST);
            break;
        case 'create':
            echo $event->create($_POST);
            break;
        case 'update':
            echo $event->update($_POST);
            break;
        case 'destroy':
            echo $event->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $event->edit($_POST['id'],$_POST); 
          break; 
    }
?>