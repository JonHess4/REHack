<?php
  session_start();
  include 'FP_Board.php';
  include 'FP_Screen.php';
  include 'FP_LogInterpreter.php';
  include 'FP_Scoreboard.php';
  
  //constants start
  
  const RE_Ed = "FP_REHACK";
  const GL_Ed = "FP_gamelog8";
  const DB = "jhess";
  const PSWRD = "11827258";
  
  class ColorRef { //for polyps and larva color/num translation
  	private static $colorToNum = array("w" => 0, "y" => 1, "o" => 2, "p" => 3, "g" => 4);
  	private static $numToColor = array("w", "y", "o", "p", "g");
  	private static $playerColor = array("1" => "P", "2" => "G", "3" => "R", "4" => "Y");
  	
  	public static function convertColorToNum($letter) {
  		return self::$colorToNum[$letter];
  	}
  	public static function convertNumberToColor($number) {
		return self::$numToColor[$number];
	}
	public static function getPlayerColor($playerNumber) {
		return self::$playerColor[$playerNumber];
	}
  }
  
  class LogInfo {
	  private static $log = array();
	  private static $lineCount = array();
	  private static $thisTurn = array();
	  
	  public static function fillLog($info) {
		 $r = sizeof($info);
		for ($j=0; $j<$r; $j++) {
			array_push(self::$log, $info[$j]);
		}
	  }
	  public static function getLog() {
		  return self::$log;
	  }
	  
	  public static function addToThisTurn($line) {
		  array_push(self::$thisTurn, $line);
	  }
	  
	  public static function getThisTurn() {
		  return self::$thisTurn;
	  }
  }
  
  //functions start
  
  function printLetters($offset, $firstChar) {
  	for ($i=0; $i<7; $i++) {
  		echo ("<SPAN STYLE='left:" . (44 + 40 * $i) . "; top:" . $offset . "; width:18px; position:absolute; z-index:200; font-weight: bold; font-size: 12px; text-align: center;'>" . chr(ord($firstChar) + $i) . "</SPAN>
  		");
  	}
  }
  function printNumbers($offset, $firstNum) {
  	for ($i=0; $i<6; $i++) {
  		echo ("<SPAN STYLE='left:" . $offset . "; top:" . (39 + 40 * $i) . "; width:18px; position:absolute; z-index:200; font-weight: bold; font-size: 12px; text-align: center;'>" . ($firstNum++) . "</SPAN>
  		");
  	}
  }
  
	function saveGame() {
		$conn = mysql_connect("localhost", DB, PSWRD);
		$res = mysql_select_db(DB);
		$reslult = mysql_query("drop table Tiles");
		$result = mysql_query("
			create table if not exists Tiles(
				tile varchar(2)
			);
		");
		$board = Board::getInstance();
		
		for ($i=0; $i<2; $i++) {
			for($j=0; $j<42; $j++) {
				$tile = $board->getTile($i, $j);
				echo "<!--" . $tile . "-->";
				$result = mysql_query("
					INSERT INTO Tiles(tile)
					values('$tile');"
				);
			}
		}
		mysql_close($conn);
	}
	function newGame() {
		$board = Board::getInstance();
		$board -> initBoard();
		
		$scoreboard = Scoreboard::getInstance();
		$scoreboard->initScoreboard();
		
		saveGame();
		
		$screen = Screen::getInstance();
		$screen -> initScreen();
		
		$conn = mysql_connect("localhost", DB, PSWRD);
		$res = mysql_select_db(DB);
		$reslult = mysql_query("drop table Tiles");
		$result = mysql_query("drop table LogFile");
		
		mysql_close($conn);
	}
	function loadGame() {
		$conn = mysql_connect("localhost", DB, PSWRD);
		$res = mysql_select_db(DB);
		$res = mysql_query("select * from Tiles");
		
		$r = mysql_num_rows($res);
		$c = mysql_num_fields($res);
		
		$savedBoard = array(array(), array(), array(), array());
		
		for ($i=0; $i<$r; $i++) {
			$row = mysql_fetch_row($res);
			for ($j=0; $j<$c; $j++) {
				if ($i < 42) {
					array_push($savedBoard[0], $row[$j]);
				} else if ($i < 84) {
					array_push($savedBoard[1], $row[$j]);
				} else if ($i < 126) {
					array_push($savedBoard[2], $row[$j]);
				} else {
					array_push($savedBoard[3], $row[$j]);
				}
			}
		}
		
		mysql_close($conn);
		
		$board = Board::getInstance();
		$board -> setBoard($savedBoard);
	}
	function recordAction($action) {
		$conn = mysql_connect("localhost", DB, PSWRD);
		$res = mysql_select_db(DB);
		$result = mysql_query("
			create table if not exists LogFile(
				action varchar(125)
			);
		");
		$result = mysql_query("
			INSERT INTO LogFile(action)
			values('$action');"
		);
		mysql_close($conn);
	}
	
  //--------------------------------------------------------------------
  //main() start
  
  $board = Board::getInstance(); // we should  probably set $board to saved board 
  $scoreboard = Scoreboard::getInstance();
  
  //All possible values of the "act" variable stored in $_GET must have a function of the same name.
  if (isset($_GET["act"])) {
	$_GET["act"]();
  }
  
  //get LogInfo
	$conn = mysql_connect("localhost", DB, PSWRD);
	$res = mysql_select_db(DB);
	$res = mysql_query("select * from LogInfo;");
	
	$r = mysql_num_rows($res);
	$info = array();
	for ($i=0; $i<$r; $i++) {
		$row = mysql_fetch_row($res);
		array_push($info, $row[0]);
	}
	mysql_close($conn);
	
	LogInfo::fillLog($info);
	
	$log = LogInfo::getLog();
	
	$strEnd = strpos($log[$_GET["L"]], "<");
	$curPlayer = substr($log[$_GET["L"]], 0, $strEnd);
	
	if (!(isset($_GET["curPlayer"]))) {
		$_GET["curPlayer"] = $curPlayer;
		$_GET["P"] = "1";
		newGame();
	}
	
	$scoreboard->setPlayer($curPlayer);
	
	while ($curPlayer == $_GET["curPlayer"]) {
		
		LogInfo::addToThisTurn($log[$_GET["L"]]);
		
		interpretLine($log[$_GET["L"]]);
		
		$_GET["L"] = "" . (min(sizeof($log) - 1, $_GET["L"] + 1));
		
		//curPlayer
		$strEnd = strpos($log[$_GET["L"]], "<");
		if (!(strpos($log[$_GET["L"]], "<"))) {
			break;
		}
		$curPlayer = substr($log[$_GET["L"]], 0, $strEnd);
	}
	
	$_GET["curPlayer"] = $curPlayer;
	
	$_GET["P"] = "" . (max(1, ($_GET["P"] + 1) % 5));
	
	if($_GET["P"] == "1") {
		$_GET["T"] =  "" . ($_GET["T"] + 1);
	}

  /*while(LogInfo::getLineCount() < sizeof($log)) {
	  interpretLine($log[LogInfo::getLineCount()]);
	  LogInfo::incrementLineCount();
  }*/
  
  //--------------------------------------------------------------------
  //HTML start
  	
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
                  <A CLASS=menu HREF="forum/viewforum.php?f=1">Updates</A> | <a class=menuRed href="donate.php">Donate</a>
                </TD>
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
############################################################  
          <TD CLASS=menu STYLE="border: solid red 1px; background-color: FFAAAA;" ALIGN=CENTER>SpeilByWeb costs $36 per month to host. If you enjoy playing games here, please consider
            <A HREF="/donate.php">donating</A> towards this expense. Thank you!
          </TD>-->
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
<!--Gamelog Link-->
                  <A HREF="<?=GL_Ed?>.php">Gamelog</A> |
<!--SaveGame Link-->
                  <A HREF="<?=RE_Ed?>.php?act=saveGame">Save Game</A> |
<!--SaveFile Link-->
                  <A HREF="saveFile.txt">View Save</A> |
<!--NewGame Link-->
                  <A HREF="FP_REHACK.php?T=1&P=1&L=0&act=newGame">New Game</A> |
<!--LoadGame Link-->
                  <A HREF="<?=RE_Ed?>.php?act=loadGame">Load Game</A> |
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
                <TD ALIGN=CENTER COLSPAN=3 BGCOLOR=cccccc>
                  <BR>
                  <!--<B>Input error -- please retry!</B>-->
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
<!-- opening table tag for scoreboard -->
                              <?php
								$scoreboard = Scoreboard::getInstance();
								$scoreboard->showScoreboard();
								?>
<!-- closing table tag for scoreboard -->
                            </TD>
                          </TR>
                        </TABLE>
                        <BR>
                      </TD>
                      <TD WIDTH=10></TD>
                      <TD>
<!-- opening screen table tag -->
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
                                        <?php
											$screen = Screen::getInstance();
											$screen->showPolyps();
											$screen->showLarva();
										?>
<!-- This <TR> is the code that displays a character's shrimp behind their screen (not yet put on the board) -->
                                      <TR>
                                        <TD ALIGN=RIGHT>Shrimp:</TD>
                                        <TD></TD>
                                        <TD COLSPAN=15>
										  <?php
											$screen = Screen::getInstance();
											for ($i=0; $i<$screen->getShrimp(); $i++) {
												echo "<IMG SRC='game/reef/images/s" . ColorRef::getPlayerColor($_GET["P"]) . ".gif'>";
											}
										  ?>
                                        </TD>
                                      </TR>
                                    </TABLE>
                                  </TD>
                                </TR>
                              </TABLE>
                            </TD>
                          </TR>
                        </TABLE> 
<!-- closing screen table tag -->
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
                                  <TD CLASS=borderred>
                                    <SPAN CLASS=yellow_text_bold><a href="FP_REHACK.php?T=<?=$_GET['T']?>&P=<?=$_GET['P']?>&L=<?=$_GET['L']?>&curPlayer=<?=$_GET['curPlayer']?>">Click Here for Next</a></SPAN>
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                              <TD>
                                                &nbsp;
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
                                                      <BR>+8 in supply
                                                    </TD>
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
                                                      <BR>+9 in supply
                                                    </TD>
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
                                                      <BR>+8 in supply
                                                    </TD>
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
                                                      <BR>+9 in supply
                                                    </TD>
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
                                                      <BR>+7 in supply
                                                    </TD>
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
                                                <BR>none
                                              </TD>
                                            </TR>
                                          </TABLE>
<!-- Upper Left Reef Board -->
                                          <P>
                                          <TABLE CELLPADDING=0 CELLSPACING=5>
                                            <TR VALIGN=TOP>
                                              <TD>
                                                <DIV STYLE="left:0px; top:0px; width:340; height:291; position:relative; border: solid 1px black;">
                                                  <?php
                                                    printLetters(4, "A");
                                                    printNumbers(0, 1);
                                                    $board -> showBoard(0);
                                                   ?>
                                                  <SPAN ID="map" STYLE="left:0; top:0; position:absolute; z-index:100;"><IMG SRC="game/reef/images/b0.jpg" ></SPAN>
                                                </DIV>
                                              </TD>
<!-- Upper Right Reef Board -->
                                            <TD>
                                                <DIV STYLE="left:0px; top:0px; width:340; height:291; position:relative; border: solid 1px black;">
                                                  <?php
                                                    printLetters(4, "H");
                                                    printNumbers(320, 1);
                                                    $board -> showBoard(1);
                                                   ?>
                                                  <SPAN ID="map" STYLE="left:0; top:0; position:absolute; z-index:100;"><IMG SRC="game/reef/images/b1.jpg" ></SPAN>
                                                </DIV>
                                              </TD>
                                         
<!-- Bottom Left Reef Board -->
                                          <P>
                                            <TR VALIGN=TOP>
                                              <TD>
                                                <DIV STYLE="left:0px; top:0px; width:340; height:291; position:relative; border: solid 1px black;">
                                                  <?php
                                                    printLetters(270, "A");
                                                    printNumbers(0, 7);
                                                    $board -> showBoard(2);
                                                   ?>
                                                  <SPAN ID="map" STYLE="left:0; top:0; position:absolute; z-index:100;"><IMG SRC="game/reef/images/b2.jpg" ></SPAN>
                                                </DIV>
                                              </TD>
<!-- Bottom Right Reef Board -->
                                              <TD>
                                                <DIV STYLE="left:0px; top:0px; width:340; height:291; position:relative; border: solid 1px black;">
                                                  <?php
                                                    printLetters(270, "H");
                                                    printNumbers(320, 7);
                                                    $board -> showBoard(3);
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
            <?php
			echo "<pre>";
				print_r(LogInfo::getThisTurn());
			echo "</pre>";
        ?>
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
                  <A HREF="http://www.amarriner.com/">Aaron Marriner</A>.
                </TD>
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

