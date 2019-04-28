<?php
	class Scoreboard { // is a singleton
		private  static $scoreboard = null;
	  
		private function __construct(){
			if (isset($_SESSION["scoreboard"])) {
				$this->scoreboard = $_SESSION["scoreboard"];
			}else {
				$this->initScoreboard();
			}
		}
		
		public static function getInstance() {
			if (self::$scoreboard == null) {
				self::$scoreboard = new Scoreboard();
			}
			return self::$scoreboard;
		}
		
		public function initScoreboard() {
			$this->scoreboard = array("0" => array("", "Player", "Consumed Polyp Tiles", "Shrimp Eaten", "Initial larva cubes"), 
				"1" => array(ColorRef::getPlayerColor("1"), "Player1", array(0, 0, 0, 0, 0), 0, array(0, 0, 0, 0, 0)), 
				"2" => array(ColorRef::getPlayerColor("2"), "Player2", array(0, 0, 0, 0, 0), 0, array(0, 0, 0, 0, 0)), 
				"3" => array(ColorRef::getPlayerColor("3"), "Player3", array(0, 0, 0, 0, 0), 0, array(0, 0, 0, 0, 0)), 
				"4" => array(ColorRef::getPlayerColor("4"), "Player4", array(0, 0, 0, 0, 0), 0, array(0, 0, 0, 0, 0)));
				
			$_SESSION["scoreboard"] = $this->scoreboard;
		}
		
		public function setPlayer($pName) {
			$this->scoreboard[$_GET["P"]][1] = $pName;
			$_SESSION["scoreboard"] = $this->scoreboard;
		}
		
		public function addPolyp($polyp) {
			$this->scoreboard[$_GET["P"]][2][ColorRef::convertColorToNum($polyp)] += 1;
			$_SESSION["scoreboard"] = $this->scoreboard;
		}
		
		public function addShrimp() {
			$this->scoreboard[$_GET["P"]][3] += 1;
			$_SESSION["scoreboard"] = $this->scoreboard;
		}
		
		public function addLarva($larva) {
			$this->scoreboard[$_GET["P"]][4][ColorRef::convertColorToNum($larva)] += 1;
			$_SESSION["scoreboard"] = $this->scoreboard;
		}
		
		public function removePolyp($polyp) {
			$this->scoreboard[$_GET["P"]][2][ColorRef::convertColorToNum($polyp)] -= 1;
		}
		
		public function showScoreboard() {
			echo "<TABLE CELLSPACING=0 CELLPADDING=3 WIDTH=100%>
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
                                          <IMG SRC='images/" . $this->scoreboard[1][0] . ".gif' WIDTH=16 HEIGHT=16 ALT='" . $this->scoreboard[1][0] . "' ALIGN=ABSMIDDLE>&nbsp;
                                        </TD>
                                        <TD>
                                          <A HREF='forum/profile.php?mode=viewprofile&u=96089&g=7' CLASS='player_ref'>" . $this->scoreboard[1][1] . "</A>
                                        </TD>
                                      </TR>
                                    </TABLE>
                                  </TD>
                                  <TD CLASS=thin>&nbsp;" . $this->scoreboard[1][2][0] . "x<IMG BORDER=1 SRC=game/reef/images/p0.jpg ALT=w WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[1][2][1] . "x<IMG BORDER=1 SRC=game/reef/images/p1.jpg ALT=y WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[1][2][2] . "x<IMG BORDER=1 SRC=game/reef/images/p2.jpg ALT=o WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[1][2][3] . "x<IMG BORDER=1 SRC=game/reef/images/p3.jpg ALT=p WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[1][2][4] . "x<IMG BORDER=1 SRC=game/reef/images/p4.jpg ALT=g WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                  </TD>
                                  <TD CLASS=thin>" . $this->scoreboard[1][3] . "</TD>
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
                                          <IMG SRC='images/" . $this->scoreboard[2][0] . ".gif' WIDTH=16 HEIGHT=16 ALT='" . $this->scoreboard[2][0] . "' ALIGN=ABSMIDDLE>&nbsp;
                                        </TD>
                                        <TD>
                                          <A HREF='forum/profile.php?mode=viewprofile&u=96091&g=7' CLASS='player_ref'>" . $this->scoreboard[2][1] . "</A>
                                        </TD>
                                      </TR>
                                    </TABLE>
                                  </TD>
                                  <TD CLASS=thin>&nbsp;" . $this->scoreboard[2][2][0] . "x<IMG BORDER=1 SRC=game/reef/images/p0.jpg ALT=w WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[2][2][1] . "x<IMG BORDER=1 SRC=game/reef/images/p1.jpg ALT=y WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[2][2][2] . "x<IMG BORDER=1 SRC=game/reef/images/p2.jpg ALT=o WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[2][2][3] . "x<IMG BORDER=1 SRC=game/reef/images/p3.jpg ALT=p WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[2][2][4] . "x<IMG BORDER=1 SRC=game/reef/images/p4.jpg ALT=g WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                  </TD>
                                  <TD CLASS=thin>" . $this->scoreboard[2][3] . "</TD>
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
                                <TR ALIGN=CENTER VALIGN=TOP BGCOLOR=#FFFF70>
                                  <TD CLASS=thin ALIGN=LEFT>
                                    <TABLE CELLSPACING=0 CELLPADDING=0>
                                      <TR>
                                        <TD>
                                          <IMG SRC='images/" . $this->scoreboard[3][0] . ".gif' WIDTH=16 HEIGHT=16 ALT='" . $this->scoreboard[3][0] . "' ALIGN=ABSMIDDLE>&nbsp;
                                        </TD>
                                        <TD>
                                          <A HREF='forum/profile.php?mode=viewprofile&u=96089&g=7' CLASS='player_ref'>" . $this->scoreboard[3][1] . "</A>
                                        </TD>
                                      </TR>
                                    </TABLE>
                                  </TD>
                                  <TD CLASS=thin>&nbsp;" . $this->scoreboard[3][2][0] . "x<IMG BORDER=1 SRC=game/reef/images/p0.jpg ALT=w WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[3][2][1] . "x<IMG BORDER=1 SRC=game/reef/images/p1.jpg ALT=y WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[3][2][2] . "x<IMG BORDER=1 SRC=game/reef/images/p2.jpg ALT=o WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[3][2][3] . "x<IMG BORDER=1 SRC=game/reef/images/p3.jpg ALT=p WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[3][2][4] . "x<IMG BORDER=1 SRC=game/reef/images/p4.jpg ALT=g WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                  </TD>
                                  <TD CLASS=thin>" . $this->scoreboard[3][3] . "</TD>
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
                                          <IMG SRC='images/" . $this->scoreboard[4][0] . ".gif' WIDTH=16 HEIGHT=16 ALT='" . $this->scoreboard[4][0] . "' ALIGN=ABSMIDDLE>&nbsp;
                                        </TD>
                                        <TD>
                                          <A HREF='forum/profile.php?mode=viewprofile&u=96089&g=7' CLASS='player_ref'>" . $this->scoreboard[4][1] . "</A>
                                        </TD>
                                      </TR>
                                    </TABLE>
                                  </TD>
                                  <TD CLASS=thin>&nbsp;" . $this->scoreboard[4][2][0] . "x<IMG BORDER=1 SRC=game/reef/images/p0.jpg ALT=w WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[4][2][1] . "x<IMG BORDER=1 SRC=game/reef/images/p1.jpg ALT=y WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[4][2][2] . "x<IMG BORDER=1 SRC=game/reef/images/p2.jpg ALT=o WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[4][2][3] . "x<IMG BORDER=1 SRC=game/reef/images/p3.jpg ALT=p WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
														". $this->scoreboard[4][2][4] . "x<IMG BORDER=1 SRC=game/reef/images/p4.jpg ALT=g WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
                                  </TD>
                                  <TD CLASS=thin>" . $this->scoreboard[4][3] . "</TD>
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
                              </TABLE>";
		}
	}
?>
