<?php

	const DB = "jhess";
	const PSWRD = "11827258";

	include 'FP_LogAddressGetter.php';
	retrieveLogs(DB, PSWRD);
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>untitled</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
</head>

<body>
	<?php
		$conn = mysql_connect("localhost", DB, PSWRD);
		$res = mysql_select_db(DB);
		$res = mysql_query("select * from GameLinks");

		$r = mysql_num_rows($res);
		echo "Number of games: " . $r;
		
		$polyps = array(0, 0, 0, 0, 0);
		
		for ($i=0; $i<$r; $i++) {
			$address = implode('', mysql_fetch_row($res));
			$strStart1 = strpos($address, "games_id=");
			$address = "http://www.spielbyweb.com/game.php?" . substr($address, $strStart1);
			$html = file_get_contents($address);
			$offset = 0;
			for ($j=0; $j<5; $j++) {
				$strStart = strpos($html, " pts", $offset) - 1;
				$val = substr($html, $strStart, 1);
				$polyps[$j] += intval($val);
				$offset = $strStart + 7;
			}
		}
		mysql_close($conn);
		
		echo "<br>White Polyp tiles were worth a total of " . $polyps[0] . " points. That's an average of " . round($polyps[0] / $r, 3) . " per game.";
		echo "<br>Yellow Polyp tiles were worth a total of " . $polyps[1] . " points. That's an average of " . round($polyps[1] / $r, 3) . " per game.";
		echo "<br>Orange Polyp tiles were worth a total of " . $polyps[2] . " points. That's an average of " . round($polyps[2] / $r, 3) . " per game.";
		echo "<br>Pink Polyp tiles were worth a total of " . $polyps[3] . " points. That's an average of " . round($polyps[3] / $r, 3) . " per game.";
		echo "<br>Gray Polyp tiles were worth a total of " . $polyps[4] . " points. That's an average of " . round($polyps[4] / $r, 3) . " per game.";
	?>
	
</body>

</html>
