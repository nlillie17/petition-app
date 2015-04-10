<?php
	
	require_once "functions.php";
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = sanitizeString($_POST['username']);
		$password = sanitizeString($_POST['password']);
		$result = findUser($username, $password);
		$rowNum= mysqli_num_rows($result);
		//check number of rows instead
		if($rowNum > 0){
			$_SESSION['un'] = $username;
			$_SESSION['pw'] = $password;
			var_dump($_SESSION);
			include "feed.php";
		} else {
			include "homePage.php";
		}
	}
	else{
		include "homePage.php";	
	}
	
	
?>
