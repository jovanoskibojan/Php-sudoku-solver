<?php
$numbers = $_POST["value"];
$row = $_POST["row"];
$col = $_POST["col"];
require 'create_matrix.php';
require 'validate.php';
$matrix = create_matrix($numbers);
$tmp = validate($matrix, $row, $col);
echo $tmp;