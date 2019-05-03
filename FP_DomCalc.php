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
		
		$polyps = array(0, 0, 0, 0, 0);
		$maxDom = array(0, 0, 0, 0, 0);
		$minDom = array(0, 0, 0, 0, 0);
		
		for ($i=0; $i<$r; $i++) {
			$address = implode('', mysql_fetch_row($res));
			$strStart1 = strpos($address, "games_id=");
			$address = "http://www.spielbyweb.com/game.php?" . substr($address, $strStart1);
			$html = file_get_contents($address);
			$offset = 0;
			$max = array();
			$min = array();
			$most = 0;
			$least = 5;
			for ($j=0; $j<5; $j++) {
				$strStart = strpos($html, " pts", $offset) - 1;
				$val = substr($html, $strStart, 1);
				$polyps[$j] += intval($val);
				$offset = $strStart + 7;
				if (intval($val) > $most) {
					$max = array($j);
					$most = intval($val);
				} else if (intval($val) == $most) {
					array_push($max, $j);
				}
				
				if (intval($val) < $least) {
					$min = array($j);
					$least = intval($val);
				} else if (intval($val) == $least) {
					array_push($min, $j);
				}
			}
			for ($j=0; $j<sizeof($max); $j++) {
				$maxDom[$max[$j]] += 1;
			}
			for ($j=0; $j<sizeof($min); $j++) {
				$minDom[$min[$j]] += 1;
			}
		}
		mysql_close($conn);
		
		echo "Number of games: " . $r . "<br>";
		
		echo "<br>White Polyp tiles were worth a total of " . $polyps[0] . " points. That's an average of " . round($polyps[0] / $r, 3) . " per game." . "<br>";
		echo "<br>Yellow Polyp tiles were worth a total of " . $polyps[1] . " points. That's an average of " . round($polyps[1] / $r, 3) . " per game." . "<br>";
		echo "<br>Orange Polyp tiles were worth a total of " . $polyps[2] . " points. That's an average of " . round($polyps[2] / $r, 3) . " per game." . "<br>";
		echo "<br>Pink Polyp tiles were worth a total of " . $polyps[3] . " points. That's an average of " . round($polyps[3] / $r, 3) . " per game." . "<br>";
		echo "<br>Gray Polyp tiles were worth a total of " . $polyps[4] . " points. That's an average of " . round($polyps[4] / $r, 3) . " per game." . "<br>" . "<br>";
		
		echo "<br>White Polyp tiles were Maximally Dominant in " . $maxDom[0] . " games." . "<br>";
		echo "<br>Yellow Polyp tiles were Maximally Dominant in " . $maxDom[1] . " games." . "<br>";
		echo "<br>Orange Polyp tiles were Maximally Dominant in " . $maxDom[2] . " games." . "<br>";
		echo "<br>Pink Polyp tiles were Maximally Dominant in " . $maxDom[3] . " games." . "<br>";
		echo "<br>Gray Polyp tiles were Maximally Dominant in " . $maxDom[4] . " games." . "<br>" . "<br>";
		
		echo "<br>White Polyp tiles were Minimally Dominant in " . $minDom[0] . " games." . "<br>";
		echo "<br>Yellow Polyp tiles were Minimally Dominant in " . $minDom[1] . " games." . "<br>";
		echo "<br>Orange Polyp tiles were Minimally Dominant in " . $minDom[2] . " games." . "<br>";
		echo "<br>Pink Polyp tiles were Minimally Dominant in " . $minDom[3] . " games." . "<br>";
		echo "<br>Gray Polyp tiles were Minimally Dominant in " . $minDom[4] . " games." . "<br>";
	?>
	
</body>

</html>
