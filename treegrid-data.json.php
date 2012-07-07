<?php
	session_start(); 
	$userid = isset($_SESSION['userid'])?$_SESSION['userid']:0; 
	include_once("config_sistem.php");
	include_once("class/class.msDB.php"); 
	include_once("class/class.Equ.php"); 
	header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');
	header('Cache-Control: no-cache, must-revalidate');
	header('Pragma: no-cache');
	header('Content-Type: application/json');
		$Equ = new Equ(true); 
		$all = $Equ->getAllEqu("SCTV");
		echo $all; 
		
?>
