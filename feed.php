<!DOCTYPE html>
<style type="text/css">
.topcorner{
	position: absolute;
	top:0;
	float: left;
}
</style>
<head>
<title> Welcome!</title>
</head>
<body>
<div id="topcorner"><a href="homePage.php">Logout</a></div>
<h1> <a href='feed.php'>Feed Page</a> </h1>
	<table>
		<tr>
			<form method="post" action="feed.php">
			<td><input type="submit" name="submit" value="New"></td>
			</form>
			<form method="post" action="feedPopular.php">
			<td><input type="submit" name="submit" value="Popular"></td>
			</form>
			<form method="post" action="newPetition.php">
			<td><input type="submit" name="submit" value="Write"></td>
			</form>
		</tr>
	</table>
	
	<?php
		require_once "functions.php";
		$result = getPetitions();
		$rows = $result->num_rows;
		echo "<table><thead><caption><b>New Petitions</br></caption></thead>";
			//echo "<th>Customer ID</th><th>Name</th><th>Address</th><th>Cookie Type></th><th>Quantity</th>";
			//echo "<th>Customer ID</th><th>Name</th><th>Address</th>";
			echo "<th>User_id</th><th>Title</th><th>Petition Text</th><th>Backers</th>";
		for($j=0;$j<$rows; $j++) {
			$result->data_seek($j);
			echo "<tr><td> ".$result->fetch_assoc()['user_id']."</td>";
			$result->data_seek($j);
			echo "<td> ".$result->fetch_assoc()['title']."</td>";
			$result->data_seek($j);
			echo "<td> ".$result->fetch_assoc()['body']."</td>";
			$result->data_seek($j);
			echo "<td> ".$result->fetch_assoc()['num_backers']."</td>";

			}

		echo"</table>";
	?>
</body>
