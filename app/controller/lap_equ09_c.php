<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('lap_equ09_m');
    $lapequ09 = new Lapequ09;

    switch ($action){
        case 'read':
            echo $lapequ09->read($_POST);
            break;
    }
?>