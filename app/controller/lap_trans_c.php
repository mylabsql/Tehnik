<?php
    $action = $_REQUEST['action'];
    $handler->loadModel('lap_trans_m');
    $laptrans = new Laptrans;

    switch ($action){
        case 'getlapTrans10':
            echo $laptrans->getlapTrans10($_POST);
            break;
    }
?>