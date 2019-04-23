<?php
	include 'FP_LogAddressGetter.php';
	include 'FP_LogParser.php';

	const DB = "jhess";
	const PSWRD = "11827258";
	
	retrieveLogs(DB, PSWRD);
	
	if (isset($_GET["chosen"])) {
		parseLog($_GET["chosen"], DB, PSWRD);
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>List of Completed Games</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="generator" content="Geany 1.32" />
</head>

<body>
	Click the game you would like to use, wait for it to load, then <a href="FP_REHACK.php?T=0&P=0&L=0">Continue to Reef Encounter</a> <br><br>
<?php
	$conn = mysql_connect("localhost", DB, PSWRD);
	$res = mysql_select_db(DB);
	$res = mysql_query("select * from GameLinks");

	$r = mysql_num_rows($res);	
	print("<table>");
	for ($i=0; $i<$r; $i++) {
		$address = implode('', mysql_fetch_row($res));
		print("<tr><td><a href='FP_DisplayCompletedGameLinks.php?chosen=" . $address . "'>Game " . $i . "</a></td></tr>");
		echo "<!-- " . $address . " -->
";
	}
	print("</table>");
	mysql_close($conn);
?>

</body>

</html>
