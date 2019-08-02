<?php
function possibleSolutions($matrix, $matrixGrid) {
	$possible_solutions = [[], [], []];
	for($i = 0; $i < 9; $i++) {
		for($j = 0; $j < 9; $j++) {
		    if($matrixGrid[$i][$j] == 0) {
			    for($s = 1, $p = 0; $s < 10; $s++) {
					$matrix[$i][$j] = $s;
					$tmp = validate($matrix, $i, $j);          
					if($tmp == 0) {
						// First intiger of array stores the position that needs to be checked next
						$possible_solutions[$i][$j][0] = 1;
						array_push($possible_solutions[$i][$j], $s);
						continue;
					}
				}
				$matrix[$i][$j] = 0;
			}
		}
	}
	return $possible_solutions;
}