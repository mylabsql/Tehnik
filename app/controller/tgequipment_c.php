<?php
    include_once("class/class.equ.php"); 
    $action = $_REQUEST['action'];
    $handler->loadModel('tgequipment_m');
    $tgequ01 = new tgequ01;

    switch ($action){
        case 'getAllEqu':
            echo $tgequ01->getAllEqu($_POST);
            break;

    }
?>