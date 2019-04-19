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
		$this->screen[2] += 1;
		$_SESSIOIN["shrimp"] = $this->screen[2];
	}
	public function removePolyp($polyp) {
		$this->screen[0][ColorRef::convertColorToNum($polyp)] -= 1;
		$_SESSION["polyps"] = $this->screen[0];
	}
	public function removeLarva($larva) {
		$this->screen[1][constPolyRef::getPlypNum($larva)] -= 1;
		$_SESSION["larva"] = $this->screen[1];
	}
	public function removeShrimp() {
		$this->screen[2] -= 1;
		$_SESSION["shrimp"] = $this->screen[2];
	}
  }

?>
