<?php
	
	require_once "login.php";
	$conn = new mysqli($hn,"root","");
	

	$query = "DROP DATABASE IF EXISTS petition";
 	$result = $conn->query($query);
 	if (!$result) {
		echo "Connection Error";
	}
	
	$result = $conn->query("CREATE DATABASE petition");
	if (!$result) {
		echo "Connection Error";
	}

	$query = "USE petition";
	$result = $conn->query($query);
	if (!$result) {
		echo "Connection Error switch";
	}

	$query = "CREATE TABLE user(
	id int NOT NULL AUTO_INCREMENT,
	name text NOT NULL,
	email text NOT NULL,
	username text NOT NULL,
	password text NOT NULL,
	PRIMARY KEY (id)
	) ENGINE=InnoDB";
	$result = $conn->query($query);
	if(!$result){
		echo "Didn't create user table successfully.";
	}

	$query = "CREATE TABLE user_petitions(
	id int NOT NULL,
	petitionID int NOT NULL,
	PRIMARY KEY (id, petitionID),
	FOREIGN KEY(id)
		REFERENCES user(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	) ENGINE=InnoDB";
	$result = $conn->query($query);
	if(!$result){
		echo "Didn't create user_petitions table successfully.";
	}

	$query = "CREATE TABLE petitions(
	id int NOT NULL,
	petitionText text NOT NULL,
	FOREIGN KEY (id)
		REFERENCES user(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	) ENGINE=InnoDB";
	$result = $conn->query($query);
	if(!$result){
		echo "Didn't create petitions table successfully. ";
	}

	$query = "CREATE TABLE saved_petitions(
	id int NOT NULL,
	petitionID int NOT NULL,
	PRIMARY KEY (id,petitionID),
	FOREIGN KEY (id)
		REFERENCES user(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	) ENGINE=InnoDB";
	$result = $conn->query($query);
	if(!$result){
		echo "Didn't create saved_petitions table successfully. ";
	}

	$query = "CREATE TABLE backed_petitions(
	id int NOT NULL,
	petitionID int NOT NULL,
	PRIMARY KEY (id,petitionID),
	FOREIGN KEY (id)
		REFERENCES user(id)
		ON DELETE CASCADE
		ON UPDATE CASCADE
	) ENGINE=InnoDB";
	$result = $conn->query($query);
	if(!$result){
		echo "Didn't create backed_petitions table successfully. ";
	}

?>

<a href="homePage.php"> Click here to get going. </a>






