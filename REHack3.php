<?php
	session_start();
	
	const RE_Ed = "REHack3";
	class constPolypRef {
		private static $polypDict = array("w" => 0, "y" => 1, "o" => 2, "p" => 3, "g" => 4);
		
		public static function getPolypNum($letter) {
			return self::$polypDict[$letter];
		}
	}

	class Board {
		private $board;

		public function __construct(){
			if (isset($_SESSION["board"])) {
				$this->board = $_SESSION["board"];
			}else {
				$this->initBoard();
			}
		}
		public function initBoard() {
			if (isset($_SESSION["board"])) {
				unset($_SESSION["board"]);
			}
			$this->board = array(
				array(	"x",	"x",	"x",	"eE",	"eE",	"eE",	"x",
						"x", 	"eE",	"eE",	"wE",	"eE",	"eE",	"x",
						"eE",	"eE",	"x", 	"eE",	"yE",	"eE",	"eE",
						"eE",	"oE",	"eE",	"eE",	"eE",	"x", 	"eE",
						"eE",	"eE",	"gE",	"x", 	"pE",	"eE",	"eE",
						"eE",	"eE",	"eE",	"eE",	"eE",	"eE",	"eE"),
				array(	"x", 	"eE",	"eE",	"eE",	"eE",	"eE",	"x",
						"eE",	"eE",	"eE",	"wE",	"x",	"eE",	"eE",
						"eE",	"eE",	"x", 	"eE",	"yE",	"eE",	"eE",
						"eE",	"oE",	"eE",	"eE",	"eE",	"eE",	"eE",
						"x", 	"eE",	"gE",	"eE",	"pE",	"eE",	"x",
						"x", 	"eE",	"eE",	"x", 	"eE",	"eE",	"x",)
			);
			$_SESSION["board"] = $this->board;
		}
		public function getBoard(){
			return $this->board;
		}
		public function setBoardToSession(){
			if (isset($_SESSION["board"])) {
				$this->board = $_SESSION["board"];
			}else {
				$this->__construct();
			}
		}
		public function getTilesPolyp($intBoard, $intIndex){
			return $this->board[$intBoard][$intIndex][0];
		}
		public function setTilesPolyp($intBoard, $intIndex, $strPolyp){
			$this->board[$intBoard][$intIndex][0] = $strPolyp;
			$_SESSION["board"] = $this->board;
		}
		public function getTilesShrimp(){
			return $this->board[$intBoard][$intIndex][1];
		}
		public function setTilesShrimp($intBoard, $intIndex, $strShrimp){
			$this->board[$intBoard][$intIndex][1] = $strShrimp;
			$_SESSION["board"] = $this->board;
		}
		public function showBoard($intSide) {
			$curBoard = $this->board[$intSide];
			$curSpot = 0;
			for ($i=0; $i<6; $i++) {
				for ($j=0; $j<7; $j++) {
					if ($curBoard[$curSpot] != "x") {
						//show polyps
						if ($curBoard[$curSpot]{0} != "e"){
							echo("<SPAN STYLE='left: " . (32 + 40 * $j) . "; top: " . (27 + 40 * $i) . "; width:0px; height: 0px; position:absolute; z-index:200; font-weight: bold; font-size: 12px;'> <IMG SRC='game/reef/images/p" . constPolypRef::getPolypNum($curBoard[$curSpot]{0}) . ".jpg' HEIGHT=32 WIDTH=32 ALT='" . $curBoard[$curSpot]{0} . "' style='border: solid 2px #0000AF;'></SPAN>
							");
						}
						//show shrimp
						if ($curBoard[$curSpot]{1} != "E"){
							echo("<SPAN STYLE='left: " . (32 + 40 * $j) . "; top: " . (27 + 40 * $i) . "; width:0px; height: 0px; position:absolute; z-index:200; font-weight: bold; font-size: 12px;'> <IMG SRC='game/reef/images/s" . $curBoard[$curSpot]{1} . ".gif' HEIGHT=32 WIDTH=32 ALT='" . $curBoard[$curSpot]{1} . "';'></SPAN>
							");
						}
						//show locations open for shrimp placement
						else if (isset($_GET["act"])) {
							if ($_GET["act"] == "shrimpLoc") {
								echo ("<span style='left:" . (42 + 40 * $j) . "; top:" . (37 + 40 * $i) . "; width:0px; height: 0px; position:absolute; z-index:501;'> <a href='" . RE_Ed . ".php?act=placeShrimp&b=" . $intSide . "&cell=" . $curSpot . "'>[+]</a></span>
								");
							}
						}
					}
					$curSpot++;
				}
			}
		}
	}
	
	//potential classes
	/*class Player {
		
	}
	class Scoreboard {
		
	}
	class Screen {
		
	}
	class FishBelly {
		
	}
	class ActionBoard {
		
	}
	class DominanceTiles {
		
	}
	class OpenSea {
		
	}*/
	
	function printLetters($firstChar) {
		for ($i=0; $i<7; $i++) {
			echo ("<SPAN STYLE='left:" . (44 + 40 * $i) . "; top:4; width:18px; position:absolute; z-index:200; font-weight: bold; font-size: 12px; text-align: center;'>" . chr(ord($firstChar) + $i) . "</SPAN>
			");
		}
	}
	function printNumbers($offset) {
		for ($i=0; $i<6; $i++) {
			echo ("<SPAN STYLE='left:" . $offset . "; top:" . (39 + 40 * $i) . "; width:18px; position:absolute; z-index:200; font-weight: bold; font-size: 12px; text-align: center;'>" . ($i + 1) . "</SPAN>
			");
		}
	}

	//potential future functions (might be moved into classes)
	/*function showActionBoard() {
	
	}
	function showScoreBoard() {
		
	}
	function showScreen() {
		
	}
	function showFishBelly() {
	
	}
	function showDominanceTiles() {
		
	}
	function showOpenSea() {
		
	}
	function showCylinderSpace() {
		
	}
	function flipDominanceTiles() {
		
	}*/
	
	
	//main()
	$board = new Board();
	if (isset($_GET["act"])) {
		if ($_GET["act"] == "placePolyp") {
			$board -> setTilesPolyp($GET["b"], $_GET["cell"], $_GET["color"]);
		}else if ($_GET["act"] == "placeShrimp") {
			$board -> setTilesShrimp($_GET["b"], $_GET["cell"], "R");
		}else if ($_GET["act"] == "refreshTurn") {
			$board -> initBoard();
		}
	}
		
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML LANG="en">

<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <TITLE>SpielByWeb: Reef Encounter </TITLE>
    <LINK REL="stylesheet" HREF="RFHack.css" TYPE="text/css">
</HEAD>

<BODY>
    <script language="JavaScript" type="text/javascript">
        var ol_width = 60;
    </script>
    <DIV ID="overDiv" STYLE="position:absolute; visibility:hidden; z-index:1000;"></DIV>
    <SCRIPT LANGUAGE="JavaScript" type="text/javascript" SRC="overlib.js">
        <!-- overLIB (c) Erik Bosrup -->
    </SCRIPT>

<!-- The below DIV tag is the container for the whole page -->

    <DIV CLASS=normal_text>

<!-- This first table gives us the header, all the basic info like the
	name of the game and log in name and links to the rest of the site  -->

        <TABLE CELLPADDING=3 CELLSPACING=0 WIDTH="100%">
            <TR>
                <TD CLASS=menu>
                    <TABLE CELLPADDING=0 CELLSPACING=0 WIDTH="100%">
                        <TR VALIGN=BOTTOM>
                            <TD COLSPAN=4>
                                <TABLE CELLPADDING=0 CELLSPACING=0 WIDTH="100%">
                                    <TR VALIGN=BOTTOM>
                                        <TD>
                                            <SPAN CLASS=h2>SpielByWeb: Reef Encounter </SPAN>
                                        </TD>
                                        <TD ALIGN=RIGHT>Logged in as:
                                            <B>Migeagin</B>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR VALIGN=TOP>
                            <TD COLSPAN=4 BGCOLOR=0066CC HEIGHT=2></TD>
                        </TR>
                        <TR VALIGN=TOP>
                            <TD COLSPAN=4>
                                <IMG SRC="images/tp.gif" WIDTH="800" HEIGHT="1" ALT="">
                            </TD>
                        </TR>
                        <TR VALIGN=TOP ALIGN=CENTER>
                            <TD CLASS=small_text_8 ALIGN=LEFT>
                                <A CLASS=menu HREF="index.php">Home</A> |
                                <A CLASS=menuRed HREF="forum/faq.php">FAQ</A>
                            </TD>
                            <TD CLASS=small_text_8>
                                <A CLASS=menu HREF="create.php">Create Game</A> |
                                <A CLASS=menu HREF="games.php">Games List</A> |
                                <A CLASS=menuRed HREF=yourgames.php>Your Games</A>
                                <A HREF="game.php?games_id=110435" CLASS=menuRed>(1)</A> |
                                <A CLASS=menu HREF="users.php">Stats</A>
                            </TD>
                            <TD CLASS=small_text_8>
                                <A CLASS=menu HREF="forum/">Forum</A> (
                                <A HREF="forum/search.php?search_id=newposts">14 new posts</A>) |
                                <A CLASS=menu HREF="forum/viewforum.php?f=1">Updates</A> | <a class=menuRed href="donate.php">Donate</a></TD>
                            <TD ALIGN=RIGHT CLASS=small_text_8>
                                <A CLASS=menu HREF=forum/profile.php?mode=viewprofile&u=96089>Profile</A> |
                                <A CLASS=menu HREF=forum/profile.php?mode=editprofile>Edit</A> |
                                <A CLASS=menu HREF=vacation.php>Going Away?</A> |
                                <A CLASS=menu HREF=login.php?logout=true>Log out</A>
                            </TD>
                        </TR>
                    </TABLE>
                </TD>
            </TR>
            <TR>

<!-- Empty table tr tag. -->

                <TD></TD>
            </TR>
            <TR>

<!--############################################################
	STUPID SERVER-MOVING UPDATE
	############################################################  -->

                <TD CLASS=menu STYLE="border: solid red 1px; background-color: FFAAAA;" ALIGN=CENTER>SpeilByWeb costs $36 per month to host. If you enjoy playing games here, please consider
                    <A HREF="/donate.php">donating</A> towards this expense. Thank you!</TD>
            </TR>

<!-- This tag holds the rest of the page -->

            <TR>
                <TD>
                    <BR>

<!-- This is the table where we begin to deal with the game at hand -->

                    <TABLE CELLSPACING=0 CELLPADDING=0 WIDTH="100%">
                        <TR>
                            <TD COLSPAN=3>
                                <TABLE CELLSPACING=0 CELLPADDING=0 WIDTH="100%">
                                    <TR VALIGN=BOTTOM>

<!-- Game number, name, and round # -->

                                        <TD>Game 110435:
                                            <SPAN CLASS=h3><A HREF="game.php?games_id=110435">BSUSmellyBoot</A></SPAN>
                                        </TD>
                                        <TD ALIGN=RIGHT>
                                            <B>Round 1</B>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=3 BGCOLOR=0066CC HEIGHT=1></TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=3 HEIGHT=1></TD>
                        </TR>

<!--############################################################
	Links to gamelog, messages, notes,  bug-report, etc.
	############################################################ -->

                        <TR VALIGN=TOP>
                            <TD WIDTH="40%">
                                <A HREF="gamelog.php?games_id=110435">Gamelog</A> |
                                <A HREF="messages.php?games_id=110435">Messages</A> |
                                <A HREF="notepad.php?games_id=110435">Notepad</A> |
                                <A HREF="/forum/viewforum.php?f=9">Bug Report</A>
                            </TD>
                            <TD ALIGN=CENTER>
                                <A CLASS=menu HREF="rules.php?game=7">Rules</A> |
                                <A CLASS=menu HREF="http://www.boardgamegeek.com">BoardGameGeek</A> |
                                <A CLASS=menu HREF="http://www.funagain.com/cgi-bin/funagain/14942?;;SBYW">Buy at Funagain</A>
                            </TD>
                            <TD ALIGN=RIGHT>
                                <SPAN CLASS=small_text>Game Started on Thu Feb 14, 2019 3:20 pm<BR>Game Updated on Thu Feb 14, 2019 3:22 pm</SPAN>
                            </TD>
                        </TR>
                        <TR>
                            <TD>&nbsp;</TD>
                        </TR>

<!-- The below <TR> is the "Input Error Please Retry" banner. -->

                        <TR>
                            <TD ALIGN=CENTER COLSPAN=3 BGCOLOR=FFAAAA>
                                <BR>
                                <B>Input error -- please retry!</B>
                                <BR>
                                <BR>
                            </TD>
                        </TR>
                        <TR>
                            <TD COLSPAN=3>&nbsp;</TD>
                        </TR>
                        <TR>

<!-- This <TD> is for the gameboard only, it contains inputs and a bunch of gameboard pieces -->

                            <TD COLSPAN=3>
                                <TABLE WIDTH=100% CELLPADDING=0 CELLSPACING=0>

<!-- This <TR> holds the player name, info on each player's larva cubes, your hand of shrimp, polyp tiles, larva cubes, and whatever is in your parrot fish -->

                                    <TR VALIGN=TOP>
                                        <TD WIDTH=50%>
                                            <TABLE CELLSPACING=0 CELLPADDING=0 WIDTH=100%>
                                                <TR>
                                                    <TD CLASS=border>
                                                        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH=100%>
                                                            <TR ALIGN=CENTER>
                                                                <TD CLASS=thin BGCOLOR='#0066CC'>
                                                                    <SPAN CLASS=yellow_text_bold>Player</SPAN>
                                                                </TD>
                                                                <TD CLASS=thin BGCOLOR='#0066CC'>
                                                                    <SPAN CLASS=yellow_text_bold>Consumed<BR>Polyp Tiles</SPAN>
                                                                </TD>
                                                                <TD CLASS=thin BGCOLOR='#0066CC'>
                                                                    <SPAN CLASS=yellow_text_bold>Shrimp<BR>Eaten</SPAN>
                                                                </TD>
                                                                <TD CLASS=thin BGCOLOR='#0066CC'>
                                                                    <SPAN CLASS=yellow_text_bold>Initial larva cubes</SPAN>
                                                                </TD>
                                                            </TR>
                                                            <TR ALIGN=CENTER VALIGN=TOP BGCOLOR=#FFFF70>
                                                                <TD CLASS=thin ALIGN=LEFT>
                                                                    <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                        <TR>
                                                                            <TD>
                                                                                <IMG SRC="images/P.gif" WIDTH=16 HEIGHT=16 ALT="P" ALIGN=ABSMIDDLE>&nbsp;</TD>
                                                                            <TD>
                                                                                <A HREF="forum/profile.php?mode=viewprofile&u=96089&g=7" CLASS="player_ref">Migeagin</A>
                                                                            </TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                                <TD CLASS=thin>&nbsp;</TD>
                                                                <TD CLASS=thin>&mdash;</TD>
                                                                <TD CLASS=thin>
                                                                    <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                        <TR>
                                                                            <TD>1x</TD>
                                                                            <TD>
                                                                                <IMG BORDER=1 SRC=game/reef/images/l2.gif ALT=[o] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                            </TD>
                                                                            <TD>&nbsp;</TD>
                                                                            <TD>1x</TD>
                                                                            <TD>
                                                                                <IMG BORDER=1 SRC=game/reef/images/l4.gif ALT=[g] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                            </TD>
                                                                            <TD>&nbsp;</TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                            <TR ALIGN=CENTER VALIGN=TOP>
                                                                <TD CLASS=thin ALIGN=LEFT>
                                                                    <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                        <TR>
                                                                            <TD>
                                                                                <IMG SRC="images/G.gif" WIDTH=16 HEIGHT=16 ALT="G" ALIGN=ABSMIDDLE>&nbsp;</TD>
                                                                            <TD>
                                                                                <A HREF="forum/profile.php?mode=viewprofile&u=96091&g=7" CLASS="player_ref">Jon Hess</A>
                                                                            </TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                                <TD CLASS=thin>&nbsp;</TD>
                                                                <TD CLASS=thin>&mdash;</TD>
                                                                <TD CLASS=thin>
                                                                    <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                        <TR>
                                                                            <TD>1x</TD>
                                                                            <TD>
                                                                                <IMG BORDER=1 SRC=game/reef/images/l0.gif ALT=[w] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                            </TD>
                                                                            <TD>&nbsp;</TD>
                                                                            <TD>1x</TD>
                                                                            <TD>
                                                                                <IMG BORDER=1 SRC=game/reef/images/l4.gif ALT=[g] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                            </TD>
                                                                            <TD>&nbsp;</TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                        </TABLE>
                                                    </TD>
                                                </TR>
                                            </TABLE>
                                            <BR>
                                        </TD>
                                        <TD WIDTH=10></TD>
                                        <TD>
                                            <TABLE CELLSPACING=0 CELLPADDING=0 WIDTH="100%">
                                                <TR>
                                                    <TD CLASS=border>
                                                        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
                                                            <TR ALIGN=CENTER>
                                                                <TD CLASS=border BGCOLOR='#0066CC'>
                                                                    <SPAN CLASS=yellow_text_bold>Behind Your Screen</SPAN>
                                                                </TD>
                                                            </TR>
                                                            <TR>
                                                                <TD CLASS=border>
                                                                    <TABLE>
                                                                        <TR>
                                                                            <TD ALIGN=RIGHT>Polyp Tiles:</TD>
                                                                            <TD></TD>
                                                                            <TD>
                                                                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                                    <TR>
                                                                                        <TD>2x</TD>
                                                                                        <TD>
                                                                                            <IMG BORDER=1 SRC=game/reef/images/p0.jpg ALT=[w] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                        </TD>
                                                                                    </TR>
                                                                                </TABLE>
                                                                            </TD>
                                                                            <TD>
                                                                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                                    <TR>
                                                                                        <TD>1x</TD>
                                                                                        <TD>
                                                                                            <IMG BORDER=1 SRC=game/reef/images/p1.jpg ALT=[y] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                        </TD>
                                                                                    </TR>
                                                                                </TABLE>
                                                                            </TD>
                                                                            <TD>
                                                                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                                    <TR>
                                                                                        <TD>1x</TD>
                                                                                        <TD>
                                                                                            <IMG BORDER=1 SRC=game/reef/images/p2.jpg ALT=[o] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                        </TD>
                                                                                    </TR>
                                                                                </TABLE>
                                                                            </TD>
                                                                            <TD>
                                                                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                                    <TR>
                                                                                        <TD>1x</TD>
                                                                                        <TD>
                                                                                            <IMG BORDER=1 SRC=game/reef/images/p4.jpg ALT=[g] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                        </TD>
                                                                                    </TR>
                                                                                </TABLE>
                                                                            </TD>
                                                                        </TR>
                                                                        <TR>
                                                                            <TD ALIGN=RIGHT>Larva Cubes:</TD>
                                                                            <TD></TD>
                                                                            <TD></TD>
                                                                            <TD></TD>
                                                                            <TD>
                                                                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                                    <TR>
                                                                                        <TD>1x</TD>
                                                                                        <TD>
                                                                                            <IMG BORDER=1 SRC=game/reef/images/l2.gif ALT=[o] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                        </TD>
                                                                                    </TR>
                                                                                </TABLE>
                                                                            </TD>
                                                                            <TD>
                                                                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                                    <TR>
                                                                                        <TD>1x</TD>
                                                                                        <TD>
                                                                                            <IMG BORDER=1 SRC=game/reef/images/l4.gif ALT=[g] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                        </TD>
                                                                                    </TR>
                                                                                </TABLE>
                                                                            </TD>
                                                                        </TR>

<!-- This <TR> is the code that displays a character's shrimp behind their screen (not yet put on the board) -->

                                                                        <TR>
                                                                            <TD ALIGN=RIGHT>Shrimp:</TD>
                                                                            <TD></TD>
                                                                            <TD COLSPAN=15>
                                                                                <IMG SRC="game/reef/images/sP.gif">
                                                                                <IMG SRC="game/reef/images/sP.gif">
                                                                                <IMG SRC="game/reef/images/sP.gif">
                                                                                <IMG SRC="game/reef/images/sP.gif">
                                                                            </TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                        </TABLE>
                                                    </TD>
                                                </TR>
                                            </TABLE>
                                            <BR>
                                        </TD>
                                        <TD WIDTH=10></TD>
                                        <TD>
                                            <TABLE CELLSPACING=0 CELLPADDING=0 WIDTH="100%">
                                                <TR>
                                                    <TD CLASS=border>
                                                        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
                                                            <TR ALIGN=CENTER>
                                                                <TD CLASS=border BGCOLOR='#0066CC'>
                                                                    <SPAN CLASS=yellow_text_bold>In Your Parrotfish</SPAN>
                                                                </TD>
                                                            </TR>
                                                            <TR>
                                                                <TD CLASS=border>
                                                                    <TABLE WIDTH=100%>
                                                                        <TR ALIGN=CENTER>
                                                                            <TD>
                                                                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                                                                    <TR>
                                                                                        <TD>1x</TD>
                                                                                        <TD>
                                                                                            <IMG BORDER=1 SRC=game/reef/images/p4.jpg ALT=[g] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                        </TD>
                                                                                        <TD>&nbsp;</TD>
                                                                                    </TR>
                                                                                </TABLE>
                                                                            </TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                        </TABLE>
                                                    </TD>
                                                </TR>
                                            </TABLE>
                                            <BR>
                                        </TD>
                                    </TR>

<!-- This <TR> is where the action interface is held -->

                                    <TR>
                                        <TD COLSPAN=5>
                                            <TABLE CELLSPACING=0 CELLPADDING=0 WIDTH="100%">
                                                <TR>
                                                    <TD CLASS=borderred>
                                                        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
                                                            <TR ALIGN=CENTER>
                                                                <TD CLASS=borderred BGCOLOR='#FF3333'>
                                                                    <SPAN CLASS=yellow_text_bold>Choose an Action</SPAN>
                                                                </TD>
                                                            </TR>
                                                            <TR>
                                                                <TD CLASS=borderred BGCOLOR="#FFFFBB">
                                                                    <TABLE WIDTH=100%>

	<!-- Action 1: Eat a shrimp -->

                                                                        <TR>
                                                                            <TD>
                                                                                <IMG SRC="game/reef/images/a1d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT>
                                                                                <B>Action 1</B>:</B> Eat one coral and a shrimp with your parrotfish
                                                                                <BR>(once at start of turn only)</TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                            <TR>
                                                                <TD CLASS=borderred BGCOLOR="#FFFFBB">
                                                                    <TABLE WIDTH=100%>

	<!-- Action 2: Use a larva cube to put down some polyp tiles -->

                                                                        <TR>
                                                                            <TD WIDTH=50%>
                                                                                <!--<A HREF="game.php?games_id=110435&uniq_id=38776430845916655750&input=a&sel=2">-->
                                                                                    <IMG SRC="game/reef/images/a2d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT BORDER=0>
                                                                                    <B>Action 2:</B>
                                                                                <!--</A>-->
                                                                                </B> Play a larva cube and polyp tiles
                                                                                <BR>(only once per turn)</TD>

	<!-- Action 6: Exchange a Consumed polyp tile for a larva cube -->

                                                                            <TD WIDTH=50%>
                                                                                <IMG SRC="game/reef/images/a6d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT>
                                                                                <B>Action 6</B>:</B> Exchange a consumed polyp tile for a larva cube of the same colour (larva cube must be played immediately)</TD>
                                                                        </TR>
                                                                        <TR>

	<!-- Action 3: Second Use a larva cube to put down some polyp tiles -->

                                                                            <TD WIDTH=50%>
                                                                                <IMG SRC="game/reef/images/a3d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT>
                                                                                <B>Action 3</B>:</B> Play a second larva cube and polyp tiles
                                                                                <BR>(only once per turn)</TD>

	<!-- Action 7: Play a cylinder -->

                                                                            <TD WIDTH=50%>
                                                                                <IMG SRC="game/reef/images/a7d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT>
                                                                                <B>Action 7</B>:</B> Acquire and play an alga cylinder</TD>
                                                                        </TR>
                                                                        <TR>

	<!-- Action 4: Introduce a Shrimp -->

                                                                            <TD WIDTH=50%>
                                                                                <A HREF="http://cs.bemidjistate.edu/qj6254sc/ReefEncounter/<?=RE_Ed?>.php?act=shrimpLoc">
                                                                                    <IMG SRC="game/reef/images/a4.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT BORDER=0>
                                                                                    <B>Action 4:</B>
                                                                                </A>
                                                                                </B> Introduce a shrimp
                                                                                <BR>(only once per turn)</TD>

	<!-- Action 8: Exchange larva cube for a polyp tile -->

                                                                            <TD WIDTH=50%>
                                                                                <!--<A HREF="game.php?games_id=110435&uniq_id=38776430845916655750&input=a&sel=8">-->
                                                                                    <IMG SRC="game/reef/images/a8d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT BORDER=0>
                                                                                    <B>Action 8:</B>
                                                                                <!--</A>-->
                                                                                </B> Exchange a larva cube for a polyp tile of the same colour</TD>
                                                                        </TR>
                                                                        <TR>

	<!-- Action 5: Move a shrimp -->

                                                                            <TD WIDTH=50%>
                                                                                <IMG SRC="game/reef/images/a5d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT>
                                                                                <B>Action 5</B>:</B> Move or remove a shrimp</TD>

	<!-- Action 9: Do none of the above actions -->

                                                                            <TD WIDTH=50%>
                                                                                <IMG SRC="game/reef/images/a9d.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT>
                                                                                <B>Action 9</B>:</B> Do none of the above</TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                            <TR>
                                                                <TD CLASS=borderred BGCOLOR="#FFFFBB">

	<!-- Action 10: Take a bundle from the open sea and end your turn -->

                                                                    <TABLE WIDTH=100%>
                                                                        <TR>
                                                                            <TD>
                                                                                <!--<A HREF="game.php?games_id=110435&uniq_id=38776430845916655750&input=a&sel=10">-->
                                                                                    <IMG SRC="game/reef/images/a10.jpg" WIDTH="50" HEIGHT="32" ALIGN=LEFT BORDER=0>
                                                                                    <B>Action 10:</B>
                                                                                <!--</A>-->
                                                                                </B> Collect a larva cube and polyp tiles from the open sea
                                                                                <BR>(must do once, at end of turn only)</TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                            <TR>
                                                                <TD CLASS=borderred BGCOLOR="#FFFFBB">

	<!-- start over -->

                                                                    <P>
                                                                        <A HREF="http://cs.bemidjistate.edu/qj6254sc/ReefEncounter/<?=RE_Ed?>.php?act=refreshTurn">[Start your turn over]</A>
                                                                    </P>
                                                                </TD>
                                                            </TR>
                                                        </TABLE>
                                                    </TD>
                                                </TR>
                                            </TABLE>
                                            <BR>
                                        </TD>
                                    </TR>

<!-- This <TR> holds the game board that can be seen by both players.
	All elements here are shared between both players. -->

                                    <TR VALIGN=TOP>
                                        <TD COLSPAN=5>
                                            <TABLE CELLSPACING=0 CELLPADDING=0 WIDTH="100%">
                                                <TR>
                                                    <TD CLASS=border>
                                                        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH="100%">
                                                            <TR ALIGN=CENTER>
                                                                <TD CLASS=border BGCOLOR='#0066CC'>
                                                                    <SPAN CLASS=yellow_text_bold>Game Board</SPAN>
                                                                </TD>
                                                            </TR>
                                                            <TR>
                                                                <TD CLASS=border>
                                                                    <TABLE CELLPADDING=0 CELLSPACING=0 WIDTH="100%">
                                                                        <TR>
                                                                            <TD ALIGN=CENTER>
                                                                                <TABLE CELLPADDING=0 CELLSPACING=2>
                                                                                    <TR ALIGN=CENTER VALIGN=BOTTOM>

<!-- Dominance Tiles here -->

	<!-- #1 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p1.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p1.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct01.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p0.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>1</B>
                                                                                        </TD>

	<!-- #2 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p2.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p2.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct11.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p0.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>2</B>
                                                                                        </TD>

	<!-- #3 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p2.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p2.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct21.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p1.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>3</B>
                                                                                        </TD>

	<!-- #4 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p3.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p3.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct31.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p1.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>4</B>
                                                                                        </TD>

	<!-- #5 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p3.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p3.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct41.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p2.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>5</B>
                                                                                        </TD>

	<!-- #6 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p4.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p4.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct51.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p2.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>6</B>
                                                                                        </TD>

	<!-- #7 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p0.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p0.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct61.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p3.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>7</B>
                                                                                        </TD>

	<!--#8 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p4.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p4.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct71.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p3.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>8</B>
                                                                                        </TD>

	<!-- #9 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p0.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p0.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct81.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p4.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>9</B>
                                                                                        </TD>

	<!-- 10 -->

                                                                                        <TD>&nbsp;
                                                                                            <BR>
                                                                                            <TABLE CELLPADDING=0 CELLSPACING=0 STYLE="border: solid 1px black;">
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p1.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p1.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                                <TR>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/ct91.gif" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                    <TD>
                                                                                                        <IMG SRC="game/reef/images/p4.jpg" WIDTH=32 HEIGHT=32>
                                                                                                    </TD>
                                                                                                </TR>
                                                                                            </TABLE>
                                                                                            <B>10</B>
                                                                                        </TD>
                                                                                    </TR>
                                                                                </TABLE>

<!-- The open sea -->

                                                                                <P>
                                                                                    <TABLE CELLPADDING=2 CELLSPACING=2 BORDER=0>
                                                                                        <TR ALIGN=CENTER VALIGN=TOP>
                                                                                            <TD WIDTH=115 BGCOLOR=#6DC0B4 STYLE="border: solid 1px black;">
                                                                                                <TABLE CELLSPACING=2 CELLPADDING=0>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG BORDER=1 SRC=game/reef/images/l0.gif ALT=[w] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                                            <BR>+8 in supply</TD>
                                                                                                    </TR>
                                                                                                    <TR>
                                                                                                        <TD></TD>
                                                                                                    </TR>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p0.jpg" HEIGHT=32 WIDTH=32 ALT="w">
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p1.jpg" HEIGHT=32 WIDTH=32 ALT="y">
                                                                                                        </TD>
                                                                                                    </TR>
                                                                                                </TABLE>
                                                                                            </TD>
                                                                                            <TD WIDTH=115 BGCOLOR=#6DC0B4 STYLE="border: solid 1px black;">
                                                                                                <TABLE CELLSPACING=2 CELLPADDING=0>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG BORDER=1 SRC=game/reef/images/l1.gif ALT=[y] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                                            <BR>+9 in supply</TD>
                                                                                                    </TR>
                                                                                                    <TR>
                                                                                                        <TD></TD>
                                                                                                    </TR>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p4.jpg" HEIGHT=32 WIDTH=32 ALT="g">
                                                                                                        </TD>
                                                                                                    </TR>
                                                                                                </TABLE>
                                                                                            </TD>
                                                                                            <TD WIDTH=115 BGCOLOR=#6DC0B4 STYLE="border: solid 1px black;">
                                                                                                <TABLE CELLSPACING=2 CELLPADDING=0>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG BORDER=1 SRC=game/reef/images/l2.gif ALT=[o] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                                            <BR>+8 in supply</TD>
                                                                                                    </TR>
                                                                                                    <TR>
                                                                                                        <TD></TD>
                                                                                                    </TR>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p0.jpg" HEIGHT=32 WIDTH=32 ALT="w">
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p0.jpg" HEIGHT=32 WIDTH=32 ALT="w">
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p2.jpg" HEIGHT=32 WIDTH=32 ALT="o">
                                                                                                        </TD>
                                                                                                    </TR>
                                                                                                </TABLE>
                                                                                            </TD>
                                                                                            <TD WIDTH=115 BGCOLOR=#6DC0B4 STYLE="border: solid 1px black;">
                                                                                                <TABLE CELLSPACING=2 CELLPADDING=0>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG BORDER=1 SRC=game/reef/images/l3.gif ALT=[p] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                                            <BR>+9 in supply</TD>
                                                                                                    </TR>
                                                                                                    <TR>
                                                                                                        <TD></TD>
                                                                                                    </TR>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p0.jpg" HEIGHT=32 WIDTH=32 ALT="w">
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p0.jpg" HEIGHT=32 WIDTH=32 ALT="w">
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p2.jpg" HEIGHT=32 WIDTH=32 ALT="o">
                                                                                                        </TD>
                                                                                                    </TR>
                                                                                                </TABLE>
                                                                                            </TD>
                                                                                            <TD WIDTH=115 BGCOLOR=#6DC0B4 STYLE="border: solid 1px black;">
                                                                                                <TABLE CELLSPACING=2 CELLPADDING=0>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG BORDER=1 SRC=game/reef/images/l4.gif ALT=[g] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                                                                                            <BR>+7 in supply</TD>
                                                                                                    </TR>
                                                                                                    <TR>
                                                                                                        <TD></TD>
                                                                                                    </TR>
                                                                                                    <TR ALIGN=CENTER>
                                                                                                        <TD>
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p3.jpg" HEIGHT=32 WIDTH=32 ALT="p">
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p4.jpg" HEIGHT=32 WIDTH=32 ALT="g">
                                                                                                            <IMG STYLE="border: solid 1px #4F4F4F;" SRC="game/reef/images/p4.jpg" HEIGHT=32 WIDTH=32 ALT="g">
                                                                                                        </TD>
                                                                                                    </TR>
                                                                                                </TABLE>
                                                                                            </TD>
                                                                                            <TD></TD>
                                                                                            <TD WIDTH=110 VALIGN=TOP STYLE="border: solid 1px black; font-size: 11px; font-weight: bold; padding-top: 6px;">Alga Cylinder Space
                                                                                                <BR>
                                                                                                <BR>
                                                                                                <BR>none</TD>
                                                                                        </TR>
                                                                                    </TABLE>

<!-- Left Reef Board -->

                                                                                    <P>
                                                                                        <TABLE CELLPADDING=0 CELLSPACING=5>
                                                                                            <TR VALIGN=TOP>
                                                                                                <TD>
                                                                                                    <DIV STYLE="left:0px; top:0px; width:340; height:291; position:relative; border: solid 1px black;">
																										<?php
																											printLetters("A");
																											printNumbers(0);
																											$board -> showBoard(0);
																										?>
                                                                                                        <SPAN ID="map" STYLE="left:0; top:0; position:absolute; z-index:100;"><IMG SRC="game/reef/images/b0.jpg" ></SPAN>

                                                                                                    </DIV>
                                                                                                </TD>

<!-- Right Reef Board -->

                                                                                                <TD>
																									<DIV STYLE="left:0px; top:0px; width:340; height:291; position:relative; border: solid 1px black;">
																									   <?php
																											printLetters("H");
																											printNumbers(320);
																											$board -> showBoard(1);
																										?>
                                                                                                        <SPAN ID="map" STYLE="left:0; top:0; position:absolute; z-index:100;"><IMG SRC="game/reef/images/b3.jpg" ></SPAN>
                                                                                                    </DIV>
                                                                                                </TD>
                                                                                            </TR>
                                                                                        </TABLE>
                                                                            </TD>
                                                                        </TR>
                                                                    </TABLE>
                                                                </TD>
                                                            </TR>
                                                        </TABLE>
                                                    </TD>
                                                </TR>
                                            </TABLE>
                                        </TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                    </TABLE>
                    <BR>
                </TD>
            </TR>

<!-- the rest is footer stuff-->

            <TR>
                <TD CLASS=menu>
                    <TABLE CELLPADDING=0 CELLSPACING=0 WIDTH=100%>
                        <TR VALIGN=TOP>
                            <TD CLASS=small_text>Reef Encounter was designed by Richard Breese; published by
                                <A HREF="http://www.whatsyourgame.it/">What's Your Game?</A> and
                                <A HREF="http://www.zmangames.com/products/store_reef.htm">Z-Man Games</A>.
                                <BR>Originally published by R&D Games with original artwork (used here at SpielByWeb) by Juliet Breese;.
                                <br>
                                <br>
                                <B>If you enjoy playing Reef Encounter please support the designer and publisher by buying a copy of the game.</B>
                                <BR>It is available in USA from
                                <A HREF="http://www.funagain.com/cgi-bin/funagain/015479?;;SBYW">Funagain Games</A>, and from other retailers around the world.
                                <br>
                                <br>Play-by-Web coding by Mikael Sheikh based on code by
                                <A HREF="http://www.amarriner.com/">Aaron Marriner</A>.</TD>
                            <TD ALIGN=RIGHT>
                                <TABLE CELLSPACING=0 CELLPADDING=0>
                                    <TR>
                                        <TD ALIGN=RIGHT CLASS=small_text>Users Registered:</TD>
                                        <TD WIDTH=3></TD>
                                        <TD CLASS=small_text>9872</TD>
                                    </TR>
                                    <TR>
                                        <TD ALIGN=RIGHT CLASS=small_text>Games Waiting:</TD>
                                        <TD WIDTH=3></TD>
                                        <TD CLASS=small_text>273</TD>
                                    </TR>
                                    <TR>
                                        <TD ALIGN=RIGHT CLASS=small_text>Games in Progress:</TD>
                                        <TD WIDTH=3></TD>
                                        <TD CLASS=small_text>89</TD>
                                    </TR>
                                    <TR>
                                        <TD ALIGN=RIGHT CLASS=small_text>Completed Games:</TD>
                                        <TD WIDTH=3></TD>
                                        <TD CLASS=small_text>98693</TD>
                                    </TR>
                                </TABLE>
                            </TD>
                        </TR>
                    </TABLE>
                </TD>
            </TR>
        </TABLE>
    </DIV>
    <script type="text/javascript">
        var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
    </script>
    <script type="text/javascript">
        var pageTracker = _gat._getTracker("UA-3991266-1");
        pageTracker._initData();
        pageTracker._trackPageview();
    </script>
</BODY>

</HTML>
