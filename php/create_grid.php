<?php
function createGrid($matrix) {
	$createdGird = [[], []];
	for($p = 0; $p < 9; $p++) {
		for($q = 0; $q < 9; $q++) {
			if($matrix[$p][$q] == 0)
				$createdGird[$p][$q] = 0;
			else
				$createdGird[$p][$q] = 1;
		}		
	}
	return $createdGird;
}