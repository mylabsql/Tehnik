<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('trans_m');
    $trans01 = new Trans01;

    switch ($action){
        case 'read':
            echo $trans01->read($_POST);
            break;
        case 'create':
            echo $trans01->create($_POST);
            break;
        case 'update':
            echo $trans01->update($_POST);
            break;
        case 'destroy':
            echo $trans01->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $trans01->edit($_POST['id'],$_POST); 
          break; 
    }
?>