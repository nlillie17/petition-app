<?php
	include "functions.php";
	@$name = $_POST['name'];
	@$email = $_POST['email'];
	@$usrname = $_POST['usrname'];
	@$class = $_POST['class'];
	@$dorm = $_POST['dorm'];
	@$pass1 = $_POST['pass1'];
	@$pass2 = $_POST['pass2'];
	$result = insertUser($name,$email,$usrname,$pass1, $pass2);
	print_r($result);
?>


