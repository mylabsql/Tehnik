<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('eq_nama_m');
    $nequ = new Nequ01;

    switch ($action){
        case 'read':
            echo $nequ->read($_POST);
            break;
        case 'create':
            echo $nequ->create($_POST);
            break;
        case 'update':
            echo $nequ->update($_POST);
            break;
        case 'destroy':
            echo $nequ->destroy($_POST['data']);
            break;            
        case 'edit':
          echo $nequ->edit($_POST['id'],$_POST); 
          break; 
    }
?>