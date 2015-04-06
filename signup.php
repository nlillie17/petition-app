<!DOCTYPE html>
<head>
<title> Welcome!</title>
</head>
<body>
<h1> Your info </h1>
<?php 
	include "functions.php";
	@$name = $_POST['name'];
	@$email = $_POST['email'];
	@$usrname = $_POST['usrname'];
	@$class = $_POST['class'];
	@$dorm = $_POST['dorm'];
	@$pass1 = $_POST['pass1'];
	@$pass2 = $_POST['pass2'];

	echo $name . " " . $email . " " . $usrname . " " . $class . " " . $dorm . " " . $pass1 . " " . $pass2;
?>
</body>

