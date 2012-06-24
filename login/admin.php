<?php
session_start();
?><div align="center" style="color:green;">
<?php
echo "Welcome " .$_SESSION['name'];
?>
<br /><a href="logout.php">Logout</a>
</div>
