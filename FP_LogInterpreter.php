<?php
	function interpretLine($line) {
		print($line . "<br>");
		$board = Board::getInstance();
		$screen = Screen::getInstance();
		$log = LogInfo::getLog();
		
		if (strpos($line, 'chose action 1') && !(strpos($line, 'chose action 10'))) {
			$strStart = strpos($line, "eating the shrimp at cell ") + 26;
			$cell = substr($line, $strStart, 2);
			//print ($line . " : ");
			//print ($shrimpLoc . " : ");
			
			$posArray = cellToBoardPos($cell);
			$board->setTilesShrimp($posArray[0], $posArray[1], "E");
			
			$strStart = strpos($line, "-tile ") + 6;
			$polyp = substr($line, $strStart, 1);
			//print ($polyp . "<br>");
			
			eatCoral($posArray[0], $posArray[1], $polyp);
			
		} else if (strpos($line, 'chose action 2') || strpos($line, 'chose action 3')) {
			
			$strStart = strpos($line, "playing a ") + 10;
			$color = substr($line, $strStart, 1);
			//print($line . " : ");
			//print($color . "<br>");
			
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
				print($line . "<br>");
				$strStart = strpos($line, "space ") + 6;
				if(substr($line, $strStart+2, 1) == "0" || substr($line, $strStart+2, 1) == "1" || substr($line, $strStart+2, 1) == "2") {
					$strLen = 3;
				} else {
					$strLen = 2;
				}
				$cell = substr($line, $strStart, $strLen);
				//print($cell . "<br>");
				
				$posArray = cellToBoardPos($cell);
				$board->setTilesPolyp($posArray[0], $posArray[1], $color);
				if($posArray[1] == 23 || $posArray[1] == 25 || $posArray[1] == (24 - 7) || $posArray[1] == (24 + 7)) {
					if ($board->getTilesPolyp($posArray[0], $posArray[1] != "e")) { // chech the growth tile in the middle
						$board->setTilesPolyp($posArray[0], 24, $color);
					}
				}
			}
			
		}  else if (strpos($line, 'chose action 4')) {
			$strStart = strpos($line, "space ") + 6;
			if(substr($line, $strStart+2, 1) == "0" || substr($line, $strStart+2, 1) == "1" || substr($line, $strStart+2, 1) == "2") {
				$strLen = 3;
			} else {
				$strLen = 2;
			}
			$cell = substr($line, $strStart, $strLen);
			$posArray = cellToBoardPos($cell);
			$screen->removeShrimp();
			$board->setTilesShrimp($posArray[0], $posArray[1], "P");
		} else if (strpos($line, 'chose action 5')) {
			$strStart = strpos($line, "from cell ") + 10;
			if(substr($line, $strStart+2, 1) == "0" || substr($line, $strStart+2, 1) == "1" || substr($line, $strStart+2, 1) == "2") {
				$strLen = 3;
			} else {
				$strLen = 2;
			}
			$cell = substr($line, $strStart, $strLen);
			$posArray = cellToBoardPos($cell);
			$board->setTilesShrimp($posArray[0], $posArray[1], "E");
			
			$strStart = strpos($line, "to cell ") + 8;
			if(substr($line, $strStart+2, 1) == "0" || substr($line, $strStart+2, 1) == "1" || substr($line, $strStart+2, 1) == "2") {
				$strLen = 3;
			} else {
				$strLen = 2;
			}
			$cell = substr($line, $strStart, $strLen);
			$posArray = cellToBoardPos($cell);
			$board->setTilesShrimp($posArray[0], $posArray[1], "P");
		} else if (strpos($line, 'chose action 6')) {
			$strStart = strpos($line, "exchanging a ") + 13;
			$color = substr($line, $strStart, 1);
			$screen->removePolyp($color);
			$screen->addLarva($color);
		} else if (strpos($line, 'chose action 7')) {
			$strStart = strpos($line, "exchanging a ") + 13;
			$color = substr($line, $strStart, 1);
			$screen->removePolyp($color);
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
