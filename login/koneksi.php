<?php
$nameSer = "localhost";
$username ="root";
$pass = "";
$dbname = "tehnik";
$koneksi = mysql_connect($names,$username,$pass)or die('error'.mysql_error());
$selecdb = mysql_select_db($dbname);
?>