<?php
	function interpretLine($line) {
		$board = Board::getInstance();
		$screen = Screen::getInstance();
		$scoreboard = Scoreboard::getInstance();
		$log = LogInfo::getLog();
		
		if (strpos($line, 'chose action 1') && !(strpos($line, 'chose action 10'))) {
			$posArray = getPosArray($line, "eating the shrimp at cell ");
			
			$board->setTilesShrimp($posArray[0], $posArray[1], "E");
			
			$strStart = strpos($line, "-tile ") + 6;
			$polyp = substr($line, $strStart, 1);
			//print ($polyp . "<br>");
			
			eatCoral($posArray[0], $posArray[1], $polyp);
			
			$scoreboard->addShrimp();
			
		} else if (strpos($line, 'chose action 2') || strpos($line, 'chose action 3')) {
			
			$strStart = strpos($line, "playing a ") + 10;
			$color = substr($line, $strStart, 1);
			//print($line . " : ");
			//print($color . "<br>");
			
			$strStart = strpos($line, "along with ") + 11;
			$numConsumed = intval(substr($line, $strStart, 1));
			for ($i=0; $i< $numConsumed; $i++) {
				$scoreboard->removePolyp($color);
			}
			
			$screen->removeLarva($color);
			
			$count = (int) $_GET["L"];
			
			//print(strpos($log[$count + 1], "chose action") . "<br>");
			//print("Here is the next line: : " . $log[$count + 1] . "<br>");
			while (!(strpos($log[$count + 1], "chose action"))) {
				
				$_GET["L"] = "" . ($_GET["L"] + 1);
				$count = (int) $_GET["L"];
				if ($count > sizeof($log)) {
					break;
				}
				$line = $log[$count];
				
				LogInfo::addToThisTurn($line);
				
				if (strpos($line, "interrupted action ")) {
					$posArray = getPosArray($line, "from cell ");
					
					$board->setTilesShrimp($posArray[0], $posArray[1], "E");
					
					$posArray = getPosArray($line, "to cell ");
					
					$board->setTilesShrimp($posArray[0], $posArray[1], ColorRef::getPlayerColor($_GET["P"]));
					
				} else {
					$posArray = getPosArray($line, "space ");
					
					$board->setTilesPolyp($posArray[0], $posArray[1], $color);
					if($posArray[1] == 23 || $posArray[1] == 25 || $posArray[1] == (17) || $posArray[1] == (31)) { // chech the growth tile in the middle
						if ($board->getTilesPolyp($posArray[0], $posArray[1] != "e")) { 
							$board->setTilesPolyp($posArray[0], 24, $color);
						}
					}
					
					if (strpos($line, "consuming a ")) {
						$strStart = strpos($line, "consuming a ") + 12;
						$consumed = substr($line, $strStart, 1);
						$scoreboard->addPolyp($consumed);
					}
				}
			}
			
		}  else if (strpos($line, 'chose action 4')) {
			$posArray = getPosArray($line, "space ");
			
			$screen->removeShrimp();
			$board->setTilesShrimp($posArray[0], $posArray[1], ColorRef::getPlayerColor($_GET["P"]));
		} else if (strpos($line, 'chose action 5')) {
			$posArray = getPosArray($line, "from cell ");
			
			$board->setTilesShrimp($posArray[0], $posArray[1], "E");
			
			$posArray = getPosArray($line, "to cell ");
			
			$board->setTilesShrimp($posArray[0], $posArray[1], ColorRef::getPlayerColor($_GET["P"]));
		} else if (strpos($line, 'chose action 6')) {
			$strStart = strpos($line, "exchanging a ") + 13;
			$color = substr($line, $strStart, 1);
			$scoreboard->removePolyp($color);
			$screen->addLarva($color);
		} else if (strpos($line, 'chose action 7')) {
			$strStart = strpos($line, "exchanging a ") + 13;
			$color = substr($line, $strStart, 1);
			$scoreboard->removePolyp($color);
		} else if (strpos($line, 'chose action 8')) {
			$strStart = strpos($line, "exchanging a ") + 13;
			$color = substr($line, $strStart, 1);
			$screen->removeLarva($color);
			$screen->addPolyp($color);
		} else if (strpos($line, 'chose action 9')) {
			
		} else if (strpos($line, 'chose action 10')) {
			$strStart = strpos($line, "picking a ") + 10;
			$larva = substr($line, $strStart, 1);
			$screen->addLarva($larva);
			
		} else {
			if (strpos($line, "ate the shrimp at cell ")) {
				$scoreboard->addShrimp();
				
				$posArray = getPosArray($line, "ate the shrimp at cell ");
			
				$board->setTilesShrimp($posArray[0], $posArray[1], "E");
			
				$strStart = strpos($line, "-tile ") + 6;
				$polyp = substr($line, $strStart, 1);
				//print ($polyp . "<br>");
			
				eatCoral($posArray[0], $posArray[1], $polyp);
			}
		}
	}
	
	function eatCoral($boardNum, $pos, $polyp) {
		$board = Board::getInstance();
		$board->setTilesPolyp($boardNum, $pos, "e");
		if ($board->getTilesPolyp($boardNum, $pos+1) == $polyp) {
			eatCoral($boardNum, $pos + 1, $polyp);
		}
		if ($board->getTilesPolyp($boardNum, $pos-1) == $polyp) {
			eatCoral($boardNum, $pos - 1, $polyp);
		}
		if ($board->getTilesPolyp($boardNum, $pos+7) == $polyp) {
			eatCoral($boardNum, $pos + 7, $polyp);
		}
		if ($board->getTilesPolyp($boardNum, $pos-7) == $polyp) {
			eatCoral($boardNum, $pos - 7, $polyp);
		}
	}
	
	function getPosArray($line, $string) {
		$strStart = strpos($line, $string) + strlen($string);
		if(substr($line, $strStart+2, 1) == "0" || substr($line, $strStart+2, 1) == "1" || substr($line, $strStart+2, 1) == "2") {
			$strLen = 3;
		} else {
			$strLen = 2;
		}
		$cell = substr($line, $strStart, $strLen);
		//print ($line . " : ");
		//print ($cell . "<br>");
		
		$posArray = cellToBoardPos($cell);
		
		return $posArray;
	}
	
	function cellToBoardPos($cell) {
		$row = substr($cell, 1);
		if (ord($cell[0]) < 72) {
			if ($row < 7) { // upper left board
				$boardNum = 0;
				$pos = (ord($cell[0]) - 65) + (($row - 1) * 7);
			} else if ($row >= 7) { //bottom left board
				$boardNum = 2;
				$pos = (ord($cell[0]) - 65) + (($row - 7) * 7);
			}
		} else if (ord($cell[0]) >= 72) {
			if ($row < 7) { // upper right board
				$boardNum = 1;
				$pos = (ord($cell[0]) - 72) + (($row - 1) * 7);
			} else if ($row >= 7) { //bottom right board
				$boardNum = 3;
				$pos = (ord($cell[0]) - 72) + (($row - 7) * 7);
			}
		}
		return array($boardNum, $pos);
	}
?>
