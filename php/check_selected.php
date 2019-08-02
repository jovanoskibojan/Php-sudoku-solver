<?php
$numbers = $_POST["value"];
$row = $_POST["row"];
$col = $_POST["col"];
require 'create_matrix.php';
require 'create_possible_solutions.php';
require 'create_grid.php';
require 'validate.php';
$matrix = create_matrix($numbers);
$matrixGrid = createGrid($matrix);
$possibleSolutions = possibleSolutions($matrix, $matrixGrid);
$selected_solution = $possibleSolutions[$row][$col];
array_shift($selected_solution);
$solutions_size = (sizeof($selected_solution));
if($solutions_size == 1)
	$tmp = "Possible solution for selected field is ";
elseif($solutions_size < 1)
	$tmp = "No solutions are found for this field.";
else {
	$tmp = "Possible solutions for selected field are ";
}
for($i = 0; $i < $solutions_size; $i++) {
	if($solutions_size > 1) {
		if($i == ($solutions_size - 1))
			$tmp .= " and " .$selected_solution[$i];
		elseif($i == ($solutions_size - 2))
			$tmp .= $selected_solution[$i];
		else
			$tmp .= $selected_solution[$i]	 .", ";
	}
	else {
		$tmp .= $selected_solution[$i];
	}
}
echo $tmp;