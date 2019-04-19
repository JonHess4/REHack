<?php
const RE_Ed = "REHack5";
const DB = "jhess";
const PSWRD = "11827258";

$conn = mysql_connect("localhost", DB, PSWRD);
$res = mysql_select_db(DB);
$result = mysql_query("drop table GameLinks");
$result = mysql_query("
	create table if not exists GameLinks(
		link varchar(125)
	);
");

for ($i = 0; $i<100; $i++) {
	$html = file_get_contents('http://www.spielbyweb.com/games.php?list=cmp&page=' . $i);
	$offset = 0;
	$len = strlen($html);
	$strLen = 14;
	while ($offset < $len) {
		
		$strStart = strpos($html, "<TD VALIGN=TOP STYLE=\"padding-top: 0px; font-size: 8pt;\">", $offset) + 57;

		$game = substr($html, $strStart, $strLen);		
		
		if ($game == "Reef Encounter") {
			
			$strStart = strpos($html, "STICKY, MOUSEOFF);\" onmouseout=\"return nd();\">", $offset) + 46;
			
			$numPlayers = substr($html, $strStart, 1);
			print("<!-- " . $numPlayers . " -->
");
			
			if ($numPlayers == "4") {
				
				$strStart = strpos($html, "<A HREF=\"game.php?games_id=", $offset) + 28;
				
				$gameLink = "www.spielbyweb.com/gamelog.php?games_id=" . substr($html, $strStart, 5);
				print("<!-- " . $gameLink . " -->
");
				$result = mysql_query("
					INSERT INTO GameLinks(link)
					values('$gameLink');"
				);
			}
		}

		$offset = $offset + $strStart + $strLen;
	}
}

mysql_close($conn);

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
	<a href="<?=RE_ED?>.php">Continue to Reef Encoutner</a>
</body>

</html>
