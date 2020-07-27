<?php
	include_once("includeMe.php");
	include_once("log.php");

	$pScore = htmlspecialchars($_POST["pScore"]);

	$mysqli = new mysqli($host, $user , $pw, $db);
	if ($mysqli->connect_errno) 
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$mysqli->query("SET @newScore = ". "'" . $mysqli->real_escape_string($pScore) . "'");
	
	$result = $mysqli->query("CALL GetRank(@newScore)");
	
	if(!$result)
	{
		echo "failed";
		writeLog("Call to GetAllNames failed");
	}
	else
	{
		writeLog("Call to GetAllNames succeeded");
	}
	
	if ($result->num_rows > 0) 
	{
		while($row = $result->fetch_assoc())
		{
			echo $row["pRank"];
		}
	} 
	else
	{
		echo "0 results";
	}
	
	$mysqli ->close();
	
?>