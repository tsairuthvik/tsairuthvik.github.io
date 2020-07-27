<?php
	include_once("includeMe.php");
	include_once("log.php");

	$mysqli = new mysqli($host, $user , $pw, $db);
	if ($mysqli->connect_errno) 
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$result = $mysqli->query("CALL CountRecords()");
	
	if(!$result)
	{
		//echo "failed";
		writeLog("Call to Count failed");
	}
	else
	{
		//echo "worked";
		writeLog("Call to Count succeeded");
	}
	
	if ($result->num_rows > 0) 
	{		
		while($row = $result->fetch_assoc())
		{
			echo $row["count"];
		}
	} 
	else
	{
		echo "0 results";
	}
	
	$mysqli ->close();
	
?>