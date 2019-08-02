<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<title>Sudoku solver</title>
		<meta name="author" content="Jovanoski Bojan">
		<meta name="description" content="Automatic sudoku solver">
		<meta name="keywords" content="sudoku, solver">
		<link rel="stylesheet" href="css/style.css" type="text/css">
		<link rel="stylesheet" href="css/modal.css" type="text/css">
	</head>
	<body>
	<form id="sudoku_inputs">
		<table id="sudoku">
			<tbody>
				<?php
				$id = 0;
				for($i = 0; $i < 9; $i++) {
					echo "\t\t\t<tr>\r\n";
					for($p = 0; $p < 9; $p++) {
						echo "\r\n\t\t\t\t" .'<td><input value="" id="id_' .$i .$p .'" type="text" name="value[]" data-row="' .$i .'" data-col="' .$p .'"></td>';
					}
					echo "\r\n\t\t\t</tr>\r\n";
					$id++;
				}		
				?>		
			</tbody>
		</table>
		<input type="hidden" id="row" name="row">
		<input type="hidden" id="col" name="col">
	</form>
	<div style="text-align: center;">
		<div class="button submit send">Solve</div>
		<div class="button reset">Reset</div>
		<div class="button selected">Solve selected</div>
		<div class="button about" id="openAbout">About</div>
	</div>
	<div id="statistics">
		<p>Execution time: <span id="execution_time"></span>		
		<p>Number of steps: <span id="step_number"></span>		
	</div>
	<!-- Modal for About section -->
	<div id="about" class="modal">

	  <div class="modal-content">
		<div class="modal-header">
			<span class="close">&times;</span>
			<h2>Sudoku solver</h2>
		</div>
		<div class="modal-body">
			<h2>How to use it</h2>
			<p>You first need to input every number that's given in the puzzle. You can navigate to the next field with tab, and to previous one with shift + tab. If everything is ok, the background color of a field will <span class="help-text manual_mumber">turn gray</span>. If an inputted number can't be in that field, the background will turn to <span class="help-text error_about">red</span>, and you need to change the number. If there are <span class="help-text errorerror_about">red fields</span> in the puzzle, you won't be able to submit the puzzle for the solution.</p>
			<p>After you have entered all the numbers, click on the <span class="help-text submit" style="color: white">Solve</span> button to submit the puzzle and solve it. The puzzle should fill in no time, and the solutions will be in the white fields</p>
			<p>After puzzle has been solved, you can see the time the algorythm needed to complete the task. This time does not take in calculation the time needed to send and recieve the data, and the time needed to display it. You can also see total numbers of steps needed (in both directions), and the maximum back and forward streak (number of steps in one direction without the need to change it).
			<p>If you only need help in solving the puzzle, and if you want only one field solved, you can click on an empty field that you wish to be solved. After you click it, it will <span class="help-text selected_field">turn blue</span>. After you've selected a field, you can click on <span class="help-text selected_field">Solve selected</span>, and you will receive all the possible solution for the selected field. In order for this to work, you first need to select an empty field.</p>
			<p>To empty all fields, and reset puzzle to initial state, click the <span class="help-text reset" style="color: white">Reset</span> button. This will reset the puzzle without any previous warnings, so be careful when clicking it.</p>
			<h2>How it works?</h2>
			<p>This Sudoku solver uses PHP for solving the puzzle, and JavaScript for comunication with PHP. It doen't use any coockies.</p>
			<p>PHP Script is based on Backtracking algorithm. First, each field gets every possible solution for that field. And each filed is filled one at the time. If all possibilities are tested, but none work, then that field is emptied, and script returns to the previous field (backtracks). Then, input another value, and continue checking forwards</p>
			<h2>Author</h2>
			<p>Creator of this Sudoku puzzle solver is <a href="http://www.jovanoskibojan.com" target="_blank">Bojan Jovanoski</a>. It's made for final theses in summer of 2019, for <a href="http://vts.su.ac.rs/" target="_blank">College of applied scienses</a> in Subotica. You can contact the creator on <a href="mailto:kontakt@jovanoskibojan.com">kontakt@jovanoskibojan.com</a> for any questions or suggestions</p>
		</div>
		</div>

	</div>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
	<script src="js/sudoku.js" type="text/javascript"></script>
	<script src="js/modal.js" type="text/javascript"></script>
	</body>
</html>