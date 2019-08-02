<?php
function validate($matrix, $row, $col) {
	$current = $matrix[$row][$col];
	$matches = 0;
	// Checking for row
	for($i = 0; $i < 9; $i++) {
		if($matrix[$row][$i] == $current)
			$matches++;
	}
	
	// Checking for column
	for($i = 0; $i < 9; $i++) {
		if($matrix[$i][$col] == $current)
			$matches++;
	}
	
	// Checking for the 3x3 box
	$position_row = $row%3;
	$position_col = $col%3;
	$left = $position_col;
	$right = 2 - $position_col;
	$up = $position_row;
	$down = 2 - $position_row;
	$tmp = array();
	
	for($i = 1; $i <= $left; $i++) {
		$rows_left = $col - $i;
		for($p = 1; $p <= $down; $p++) {
			$colums_left = $row + $p;
			array_push($tmp, $matrix[$colums_left][$rows_left]);
		}		
		for($p = 1; $p <= $up; $p++) {
			$colums_left = $row - $p;
			array_push($tmp, $matrix[$colums_left][$rows_left]);
		}
	}	
	for($i = 1; $i <= $right; $i++) {
		$rows_left = $col + $i;
		for($p = 1; $p <= $down; $p++) {
			$colums_left = $row + $p;
			array_push($tmp, $matrix[$colums_left][$rows_left]);
		}		
		for($p = 1; $p <= $up; $p++) {
			$colums_left = $row - $p;
			array_push($tmp, $matrix[$colums_left][$rows_left]);
		}
	}
	
	foreach($tmp as $check) {
		if($check == $current)
			$matches++;
	}
	
	return $matches -= 2;	
}