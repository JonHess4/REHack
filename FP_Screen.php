<?php
class Screen { // is a singleton
	private  static $screen = null;
  
  	private function __construct(){
  		if (isset($_SESSION["screen"])) {
  			$this->screen = $_SESSION["screen"];
  		}else {
  			$this->initScreen();
  		}
  	}
  	
  	public static function getInstance() {
		if (self::$screen == null) {
			self::$screen = new Screen();
		}
		return self::$screen;
	}
  	
  	public function initScreen() {
		$this->screen = array(1 => array(array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), 4), 
							2 => array(array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), 4), 
							3 => array(array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), 4), 
							4 => array(array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), 4));
		
  		$_SESSION["screen"] = $this->screen;
	}
	public function addPolyp($polyp) {
		$this->screen[$_GET["P"]][0][ColorRef::convertColorToNum($polyp)] += 1;
		$_SESSION["screen"] = $this->screen;
	}
	public function addLarva($larva) {
		$this->screen[$_GET["P"]][1][ColorRef::convertColorToNum($larva)] += 1;
		$_SESSION["screen"] = $this->screen;
	}
	public function addShrimp() {
		if ($this->screen[2] < 4) {
			$this->screen[$_GET["P"]][2] += 1;
			$_SESSIOIN["screen"] = $this->screen;
		}
	}
	public function removePolyp($polyp) {
		if ($this->screen[$_GET["P"]][0][ColorRef::convertColorToNum($polyp)] > 0) {
			$this->screen[$_GET["P"]][0][ColorRef::convertColorToNum($polyp)] -= 1;
			$_SESSION["screen"] = $this->screen;
		}
	}
	public function removeLarva($larva) {
		if ($this->screen[$_GET["P"]][1][ColorRef::convertColorToNum($larva)] > 0) {
			$this->screen[$_GET["P"]][1][ColorRef::convertColorToNum($larva)] -= 1;
			$_SESSION["screen"] = $this->screen;
		}
	}
	public function removeShrimp() {
		if ($this->screen[$_GET["P"]][2] > 0) {
			$this->screen[$_GET["P"]][2] -= 1;
			$_SESSION["screen"] = $this->screen;
		}
	}
	public function showScreen() {
		echo "<tr><TD ALIGN=RIGHT>Polyp Tiles:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[1][0][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/p" . $i . ".jpg ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>";
	
		echo "<tr><TD ALIGN=RIGHT>Larva Cubes:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[1][1][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/l" . $i . ".gif ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>
			  <TR>
				<TD ALIGN=RIGHT>Shrimp:</TD>
				<TD></TD>
				<TD COLSPAN=15>";
					for ($i=0; $i<$this->screen[1][2]; $i++) {
						echo "<IMG SRC='game/reef/images/sP.gif'>";
					}
                echo"</TD>
            </TR>
";
		
		echo "<tr><TD ALIGN=RIGHT>Polyp Tiles:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[2][0][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/p" . $i . ".jpg ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>";
	
		echo "<tr><TD ALIGN=RIGHT>Larva Cubes:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[2][1][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/l" . $i . ".gif ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>
			  <TR>
				<TD ALIGN=RIGHT>Shrimp:</TD>
				<TD></TD>
				<TD COLSPAN=15>";
					for ($i=0; $i<$this->screen[2][2]; $i++) {
						echo "<IMG SRC='game/reef/images/sG.gif'>";
					}
                echo"</TD>
            </TR>
";
		
		echo "<tr><TD ALIGN=RIGHT>Polyp Tiles:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[3][0][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/p" . $i . ".jpg ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>";
	
		echo "<tr><TD ALIGN=RIGHT>Larva Cubes:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[3][1][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/l" . $i . ".gif ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>
			  <TR>
				<TD ALIGN=RIGHT>Shrimp:</TD>
				<TD></TD>
				<TD COLSPAN=15>";
					for ($i=0; $i<$this->screen[3][2]; $i++) {
						echo "<IMG SRC='game/reef/images/sR.gif'>";
					}
                echo"</TD>
            </TR>
";
		
		echo "<tr><TD ALIGN=RIGHT>Polyp Tiles:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[4][0][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/p" . $i . ".jpg ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>";
	
		echo "<tr><TD ALIGN=RIGHT>Larva Cubes:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[4][1][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/l" . $i . ".gif ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>
			  <TR>
				<TD ALIGN=RIGHT>Shrimp:</TD>
				<TD></TD>
				<TD COLSPAN=15>";
					for ($i=0; $i<$this->screen[4][2]; $i++) {
						echo "<IMG SRC='game/reef/images/sY.gif'>";
					}
                echo"</TD>
            </TR>
";
	}
  }

?>
