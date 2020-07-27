<?php
	function writeLog($log)
	{
		date_default_timezone_set('America/Los_Angeles');
		file_put_contents('./log_'.date("j_n_Y").".txt",date("j-n-Y h:i:sa")." - ".$log." \r\n", FILE_APPEND);
	}
?>