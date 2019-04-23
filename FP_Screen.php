<?php
class Screen { // is a singleton
	private  static $screen = null;
  
  	private function __construct(){
  		if (isset($_SESSION["polyps"]) && isset($_SESSION["larva"]) &&isset($_SESSION["shrimp"])) {
  			$this->screen = array($_SESSION["polyps"], $_SESSION["larva"], $_SESSION["shrimp"]);
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
		$this->screen = array(array(0, 0, 0, 0, 0), array(0, 0, 0, 0, 0), 4);
		
  		$_SESSION["polyps"] = $this->screen[0];
  		$_SESSION["larva"] = $this->screen[1];
  		$_SESSION["shrimp"] = $this->screen[2];	
	}
	public function getPolyps() {
		return $this->screen[0];
	}
	public function getLarva() {
		return $this->screen[1];
	}
	public function getShrimp() {
		return $this->screen[2];
	}
	public function setShrimp($numShrimp) {
		$this->screen[2] = $numShrimp;
		$_SESSION["shrimp"] = $numShrimp;
	}
	public function addPolyp($polyp) {
		$this->screen[0][ColorRef::convertColorToNum($polyp)] += 1;
		$_SESSION["polyps"] = $this->screen[0];
	}
	public function addLarva($larva) {
		$this->screen[1][ColorRef::convertColorToNum($larva)] += 1;
		$_SESSION["larva"] = $this->screen[1];
	}
	public function addShrimp() {
		if ($this->screen[2] < 4) {
			$this->screen[2] += 1;
			$_SESSIOIN["shrimp"] = $this->screen[2];
		}
	}
	public function removePolyp($polyp) {
		if ($this->screen[0][ColorRef::convertColorToNum($polyp)] > 0) {
			$this->screen[0][ColorRef::convertColorToNum($polyp)] -= 1;
			$_SESSION["polyps"] = $this->screen[0];
		}
	}
	public function removeLarva($larva) {
		if ($this->screen[1][ColorRef::convertColorToNum($larva)] > 0) {
			$this->screen[1][ColorRef::convertColorToNum($larva)] -= 1;
			$_SESSION["larva"] = $this->screen[1];
		}
	}
	public function removeShrimp() {
		if ($this->screen[2] > 0) {
			$this->screen[2] -= 1;
			$_SESSION["shrimp"] = $this->screen[2];
		}
	}
	public function showPolyps() {
		echo "<tr><TD ALIGN=RIGHT>Polyp Tiles:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[0][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/p" . $i . ".jpg ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>";
	}
	public function showLarva() {
		echo "<tr><TD ALIGN=RIGHT>Larva Cubes:</TD>";
		for ($i=0; $i<5; $i++) {
			echo "
			<td></td>
				<TD>
					<TABLE CELLSPACING=0 CELLPADDING=0>
						<TR>
							<TD>" . $this->screen[1][$i] . "x</TD>
							<TD>
								<IMG BORDER=1 SRC=game/reef/images/l" . $i . ".gif ALT=[" . ColorRef::convertNumberToColor($i) . "] WIDTH=16 HEIGHT=16 ALIGN=ABSMIDDLE>
							</TD>
						</TR>
                    </TABLE>
                </TD>
";
		}
		echo "</tr>";
	}
  }

?>
