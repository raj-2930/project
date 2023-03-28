<?php session_start();
	session_destroy();
	setcookie('user','Try After 20 sec',time()+10);
	header("location:login.php");
?>
