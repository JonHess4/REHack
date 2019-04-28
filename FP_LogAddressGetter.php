<?php
function retrieveLogs($db, $pswrd) {
	$conn = mysql_connect("localhost", $db, $pswrd);
	$res = mysql_select_db($db);
	$result = mysql_query("drop table GameLinks");
	$result = mysql_query("
		create table if not exists GameLinks(
			link varchar(125)
		);
	");
	
	for ($i = 0; $i<100; $i++) {
		$html = file_get_contents('http://www.spielbyweb.com/games.php?list=cmp&page=' . $i);
		$len = strLen($html);
		$offset = 0;
		$strLen = 14;
		for ($j=0; $j<50; $j++) {
			
			$strStart = strpos($html, "<TD VALIGN=TOP STYLE=\"padding-top: 0px; font-size: 8pt;\">", $offset) + 57;

			$game = substr($html, $strStart, $strLen);
			
			if ($game == "Reef Encounter") {
				
				$strStart2 = strpos($html, "STICKY, MOUSEOFF);\" onmouseout=\"return nd();\">", $offset) + 46;
				
				$numPlayers = substr($html, $strStart2, 1);

				
				if ($numPlayers == "4") {
					
					$strStart3 = strpos($html, "<A HREF=\"game.php?games_id=", $offset) + 27;
					
					$gameLink = "http://www.spielbyweb.com/gamelog.php?games_id=" . substr($html, $strStart3, 6);

					$result = mysql_query("
						INSERT INTO GameLinks(link)
						values('$gameLink');"
					);
					//echo "<!-- " . $gameLink . " -->
//";
				}
			}

			$offset = $strStart + $strLen;
		}
	}

	mysql_close($conn);
}

?>
