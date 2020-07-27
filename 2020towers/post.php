<?php
	include_once("includeMe.php");
	include_once("log.php");

	$pName = htmlspecialchars($_POST["pName"]);
	$pScore = htmlspecialchars($_POST["pScore"]);
	
	$summation = array();
	
	$mysqli = new mysqli($host, $user , $pw, $db);
	if ($mysqli->connect_errno) 
	{
		echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	$sql = $mysqli->prepare("INSERT INTO Leaderboard (pName,pScore) VALUES (?,?)");
	$sql->bind_param('ss', $pName, $pScore);

	if($sql->execute())
	{
		writeLog("Wrote ".$pName." ".$pScore." to database");
	}
	else
	{
		writeLog("Failed to write ".$pName." ".$pScore." to database");
	}	
?>