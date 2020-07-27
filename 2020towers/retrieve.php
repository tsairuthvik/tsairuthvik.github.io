<?php

	// get players in range of ranks
	
	// STEP 1 -- GET POST VARIABLES AND ESTABLISH CONNECTION
	include_once("includeMe.php");
	include_once("log.php");

	$lower = htmlspecialchars($_POST["lower"]);
	$upper = htmlspecialchars($_POST["upper"]);
	
	// FOR BROWSER TESTING:
	//$lower = htmlspecialchars($_GET["lower"]);
	//$upper = htmlspecialchars($_GET["upper"]);

	$summation = array();
	
	$mysqli = new mysqli($host, $user , $pw, $db);
	if ($mysqli->connect_errno) 
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	// STEP 2 -- GET SCORES IN RANGE
	$mysqli->query("SET @lower = ". "'" . $mysqli->real_escape_string($lower) . "'");
	$mysqli->query("SET @upper = ". "'" . $mysqli->real_escape_string($upper) . "'");
	$results = $mysqli->query("CALL GetRankInRange(@lower, @upper)");
	
	if(!$results)
	{
		die("Error running query");
	}
	else
	{
		//writeLog('SQL query successful: '.$sql);
	}
	
	if ($results->num_rows > 0) 
	{
		
		// store each line in an array and then push it into 'summation'
		while($row = $results->fetch_assoc())
		{			
			$entry = array(
				"pName"=>$row["pName"],
				"pScore"=>$row["pScore"],
				"pRank"=>$row["pRank"]
			);
			array_push($summation, $entry);
		}
	} 
	else
	{
		echo "0 results";
	}
	
	
	// STEP 3 -- GET 2 SCORES ABOVE PLAYER AND 7 SCORES BELOW PLAYER, STORE THEM IN THE SAME ARRAY

	
	
	// STEP 3 -- REPLY WITH ARRAY AS JSON
	$output = json_encode($summation);
	echo $output;
	
	
	
?>