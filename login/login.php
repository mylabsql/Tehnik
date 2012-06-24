<?php
	session_start();	//to restrict the access
	include "koneksi.php";	
	
	$name = stripslashes(trim($_POST["username"]));
	$password = stripslashes(trim($_POST["password"]));    
	$query = sprintf("select * from formlogin where username='%s' and password='%s'", mysql_real_escape_string($name),mysql_real_escape_string($password));
	$sql = mysql_query($query);
	$result = mysql_fetch_row($sql);
 	
	if($result>1)
	{
		$_SESSION['id']=$result[0]; //session id
		$_SESSION['name']=$name; //session username
		echo "{success: true}";
	} 
	else 
	{
		echo "{success: false, errors: { reason: 'Login failed. Try again.' }}";
	}
?>