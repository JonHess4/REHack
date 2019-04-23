<?php
class Board { // is a singleton
  	private  static $board = null;
  
  	private function __construct(){
  		if (isset($_SESSION["board"])) {
  			$this->board = $_SESSION["board"];
  		}else {
  			$this->initBoard();
  		}
  	}
  	
  	public static function getInstance() {
		if (self::$board == null) {
			self::$board = new Board();
		}
		return self::$board;
	}
  	
  	public function initBoard() {
  		$this->board = array(
  			array("x",	"x",	"x",	"eE",	"eE",	"eE",	"x",
  					"x", 	"eE",	"eE",	"wE",	"eE",	"eE",	"x",
  					"eE",	"eE",	"x", 	"eE",	"yE",	"eE",	"eE",
  					"eE",	"oE",	"eE",	"eE",	"eE",	"x", 	"eE",
  					"eE",	"eE",	"gE",	"x", 	"pE",	"eE",	"eE",
  					"eE",	"eE",	"eE",	"eE",	"eE",	"eE",	"eE"),
  			array("x", 	"x",	"x",	"eE",	"eE",	"eE",	"x",
  					"eE",	"eE",	"eE",	"wE",	"eE",	"eE",	"x",
  					"eE",	"yE",	"eE", 	"eE",	"x",	"eE",	"eE",
  					"eE",	"x",	"eE",	"eE",	"eE",	"oE",	"eE",
  					"eE", 	"eE",	"gE",	"eE",	"pE",	"eE",	"eE",
  					"x", 	"eE",	"eE",	"eE", 	"eE",	"eE",	"x",),
  			array("x",	"eE",	"eE",	"x",	"eE",	"eE",	"eE",
  					"x", 	"eE",	"eE",	"wE",	"eE",	"eE",	"x",
  					"eE",	"eE",	"eE", 	"x",	"yE",	"eE",	"eE",
  					"eE",	"oE",	"eE",	"eE",	"eE",	"x", 	"eE",
  					"x",	"eE",	"gE",	"eE", 	"pE",	"eE",	"eE",
  					"x",	"eE",	"eE",	"eE",	"x",	"eE",	"eE"),
  			array("x", 	"eE",	"eE",	"eE",	"eE",	"eE",	"x",
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
  	public function setBoard($newBoard){
  		$this->board = $newBoard;
  		$_SESSION["board"] = $this->board;
  	}
  	public function getTile($intBoard, $intIndex) {
		if ($intIndex > 41 || $intIndex < 0) {
			return false;
		} else {
			return $this->board[$intBoard][$intIndex];
		}
	}
  	public function getTilesPolyp($intBoard, $intIndex){
		if ($intIndex > 41 || $intIndex < 0) {
			return false;
		} else {
			return $this->board[$intBoard][$intIndex][0];
		}
  	}
  	public function setTilesPolyp($intBoard, $intIndex, $strPolyp){
		if ($intIndex > 41 || $intIndex < 0) {
			return false;
		} else {
			$this->board[$intBoard][$intIndex][0] = $strPolyp;
			$_SESSION["board"] = $this->board;
		}
  	}
  	public function getTilesShrimp($intBoard, $intIndex){
		if ($intIndex > 41 || $intIndex < 0) {
			return false;
		} else {
			if ($this->board[$intBoard][$intIndex] != "x") {
				return $this->board[$intBoard][$intIndex][1];
			}else {
				return "x";
			}
		}
  	}
  	public function setTilesShrimp($intBoard, $intIndex, $strShrimp){
		if ($intIndex > 41 || $intIndex < 0) {
			return false;
		} else {
			$this->board[$intBoard][$intIndex][1] = $strShrimp;
			$_SESSION["board"] = $this->board;
		}
  	}
  	public function showBoard($intSide) {
  		$curBoard = $this->board[$intSide];
  		$curSpot = 0;
  		for ($i=0; $i<6; $i++) {
  			for ($j=0; $j<7; $j++) {
  				if ($curBoard[$curSpot] != "x") {
  					//show polyps
  					if ($curBoard[$curSpot]{0} != "e"){
  						echo("<SPAN STYLE='left: " . (32 + 40 * $j) . "; top: " . (27 + 40 * $i) . "; width:0px; height: 0px; position:absolute; z-index:200; font-weight: bold; font-size: 12px;'> <IMG SRC='game/reef/images/p" . ColorRef::convertColorToNum($curBoard[$curSpot]{0}) . ".jpg' HEIGHT=32 WIDTH=32 ALT='" . $curBoard[$curSpot]{0} . "' style='border: solid 2px #0000AF;'></SPAN>
  						");
  					}
  					//show shrimp
  					if ($curBoard[$curSpot]{1} != "E"){
  						echo("<SPAN STYLE='left: " . (32 + 40 * $j) . "; top: " . (27 + 40 * $i) . "; width:0px; height: 0px; position:absolute; z-index:200; font-weight: bold; font-size: 12px;'> <IMG SRC='game/reef/images/s" . $curBoard[$curSpot]{1} . ".gif' HEIGHT=32 WIDTH=32 ALT='" . $curBoard[$curSpot]{1} . "';'></SPAN>
  						");
  						//show moveable shrimp
  						if (isset($_GET["act"])) { 
							if ($_GET["act"] == "moveShrimp") {
								echo ("<span style='left:" . (42 + 40 * $j) . "; top:" . (37 + 40 * $i) . "; width:0px; height: 0px; position:absolute; z-index:501;'> <a href='" . RE_Ed . ".php?act=removeShrimp&b=" . $intSide . "&cell=" . $curSpot . "'>[+]</a></span>
								");
							}
						}
  					}
  					//show locations open for shrimp placement
  					else if (isset($_GET["act"])) {
  						if ($_GET["act"] == "shrimpLoc") {
  							echo ("<span style='left:" . (42 + 40 * $j) . "; top:" . (37 + 40 * $i) . "; width:0px; height: 0px; position:absolute; z-index:501;'> <a href='" . RE_Ed . ".php?act=placeShrimp&b=" . $intSide . "&cell=" . $curSpot . "&color=" . $_SESSION["color"] . "'>[+]</a></span>
  							");
  						}
  					}
  				}
  				$curSpot++;
  			}
  		}
  	}
  }

?>
