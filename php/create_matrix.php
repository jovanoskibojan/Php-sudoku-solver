<?php
function create_matrix($numbers) {
	$matrix = [];
	$tmp = 9;
	$count = 0;
	$tmp_array = [];
	foreach($numbers as $number) {
		array_push($tmp_array, $number);
		$count++;
		if($count % $tmp == 0) {
			array_push($matrix, $tmp_array);
			$tmp_array = [];
		}
	}
	return $matrix;
}