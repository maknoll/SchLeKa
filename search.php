	<?php

	include('includes/db.php');

	$param = $_GET["term"]; 

	//make connection  
	$db = connect();

	//query the database

	$query = pg_query($db, "SELECT id, question FROM questions WHERE question LIKE '%$param%'");

	for ($x = 0, $numrows = pg_num_rows($query); $x < $numrows; $x++) {  
		$row = pg_fetch_assoc($query); 

		$questions[$x] = array("id" => $row["id"],"question" => $row["question"]);  
	}

	//echo JSON to page
	echo json_encode($questions);  

	disconnect($db);