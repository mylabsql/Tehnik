<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('lap_equ10_m');
    $lap_equ10 = new Lap_equ10;

    switch ($action){
        case 'read':
            echo $lap_equ10->read($_POST);
            break;
    }
?>