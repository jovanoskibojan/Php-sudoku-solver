<?php
error_reporting(E_ERROR | E_PARSE);
$numbers = $_POST["value"];

require 'create_matrix.php';
require 'create_grid.php';
require 'validate.php';
require 'create_possible_solutions.php';
// Creates an array from plain numbers from JS
$matrix = create_matrix($numbers);
// Creates a grid of numbers that are fixed (1), and the ones that needs changing (0)
$matrixGrid = createGrid($matrix);
// Creates an array of possible solutions for each field in 3d array
$possibleSolutions = possibleSolutions($matrix, $matrixGrid);

// Starting measure of time
$start = microtime(true);

// Creating possible solutions
for($r = 0; $r < 100; $r++) {
	for($i = 0; $i < 9; $i++) {
		for($j = 0; $j < 9; $j++) {
			if($matrixGrid[$i][$j] == 0) {
				$possible_solutions_size = sizeof($possibleSolutions[$i][$j]);
				if($possible_solutions_size == 2) {
					$matrix[$i][$j] = $possibleSolutions[$i][$j][1];
					$matrixGrid[$i][$j] = 1;
					unset($possibleSolutions[$i][$j]);
				}
			}
		}
	}
	$possibleSolutions = possibleSolutions($matrix, $matrixGrid);
}
$i = 0;
$j = 0;
$counter = 0;
$back_counter = 0;
$back_counter_tmp = 0;
$back_counter_max = 0;
$forward_counter = 0;
$forward_counter_tmp = 0;
$forward_counter_max = 0;
while ($i < 9) {
    while ($j < 9) {
        $back = false;
        $found = false;
		$counter++;
        if($matrixGrid[$i][$j] == 0) {
            $lastChecked = $possibleSolutions[$i][$j][0];
            for($c = $lastChecked; $c < sizeof($possibleSolutions[$i][$j]); $c++) {
                $matrix[$i][$j] = $possibleSolutions[$i][$j][$c];
                $tmp = validate($matrix, $i, $j);
                if($tmp == 0) {
                  $found = true;
                  break;
                }
                else {
                    $found = false;
                }				
            }
          $possibleSolutions[$i][$j][0] = ($c + 1);
          if($found == false) {
            $possibleSolutions[$i][$j][0] = 1;
			$matrix[$i][$j] = 0;
            do {
              $j--;
              if($j < 0) {
                $j = 8;
                $i--;
                if($i < 0) {
                  $i = 0;
                  $results = [
					solution_found => "0",
					message => "Solution is not found, sudoku is probably impossible to solve. Number of steps tried: " .$counter,
				];
				$send_data =  json_encode($results);
				ob_clean();
				echo $send_data;
				die;
                  die;
                }
              }                
            } while ($matrixGrid[$i][$j] == 1);
            $back = true;
          }
        }
        if($back == false) {
            $j++;
			$forward_counter++;
			$forward_counter_tmp++;
		}
		else {
			$back_counter++;
			$back_counter_tmp++;
		}
		if($back_counter_max < $back_counter_tmp) {
			$back_counter_max = $back_counter_tmp;
			$back_counter_tmp = 0;
		}
		if($forward_counter_max < $forward_counter_tmp) {
			$forward_counter_max = $forward_counter_tmp;
			$forward_counter_tmp = 0;
		}
    }
    if($back == false) {
        $i++;
	}
    $j = 0;
	$loop_time = microtime(true) - $start;
	if($loop_time >= 28) {
		$results = [
			solution_found => "0",
			message => "Maximum execution time exceeded, solution not found. Number of steps tried: " .$counter,
		];
		$send_data =  json_encode($results);
		ob_clean();
		echo $send_data;
	    die;
	}
}
$time_elapsed_secs = microtime(true) - $start;
$results = [
	"solution_found" => "1",
	"matrix" => $matrix,
	"steps" => $counter,
	"_time" => $time_elapsed_secs,
	"backs" => $back_counter,
	"back_max" => $back_counter_tmp,
	"forwards" => $forward_counter,
	"forward_max" => $forward_counter_max,
];
$send_data =  json_encode($results);
ob_clean();
echo $send_data;