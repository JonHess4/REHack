<?php
function parseLog($address, $db, $pswrd) {
	$conn = mysql_connect("localhost", $db, $pswrd);
	
	$res = mysql_select_db($db);
	
	$result = mysql_query("drop table LogInfo");
	
	$result = mysql_query("
		create table if not exists LogInfo(
			logLine varchar(300)
		);
	");
		
	$html = file_get_contents($address);
				
	$offset = 0;
		
	$offset4Round = 0;
		
	$numActions = substr_count($html, "CLASS=\"player_ref_bold\">");
		
	$numRounds = substr_count($html, "Round");
		
	$array = array_fill(0, $numRounds, array());
		
	for ($j=0; $j<$numActions; $j++) {
			
		$strStart = strpos($html, "CLASS=\"player_ref_bold\">", $offset) + 24;
			
		$nextRound = strpos($html, "Round", $offset4Round);
			
		if ( $nextRound < $strStart && $nextRound) {
			$numRounds = $numRounds - 1;
			$offset4Round = $nextRound + 5;
		} else if (strpos($html, "Game Setup") < $strStart) {
			break;
		}
		
		$strLen = strpos($html, "</td>", $strStart) - $strStart;
			$action = substr($html, $strStart, $strLen);					
			array_push($array[$numRounds], $action);
		
		//echo "<!-- " . $action . " -->
//";
		$offset = $strStart + $strLen;
	}
	
	for ($j=0; $j<sizeof($array); $j++) {
		for ($k=0; $k<sizeof($array[$j]); $k++) {
			$result = mysql_query("
				INSERT INTO LogInfo(logLine)
				values('" . $array[$j][$k] . "');"
			);
		}
	}
	
	$result = mysql_query("
		INSERT INTO LogInfo(logLine)
		values('nextGame');"
	);
	mysql_close($conn);
	
}

?>
