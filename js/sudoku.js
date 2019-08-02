$(document).ready(function() {
	
	// Check if the entered character is number
    $("input").keydown(function (e) {
		var car_num = $(this).val().length;
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                // let it happen, don't do anything
				$(this).removeClass("selected_field");
				return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 49 || e.keyCode > 57)) && (e.keyCode < 97 || e.keyCode > 105) || (car_num >= 1)) {
			$(this).removeClass("selected_field");
            e.preventDefault();
        }		
    });
	
	// Checks if entered number is valid in that field
	$("input").keyup(function() {
		var field = $(this);
		var this_val = $(this).val();
		$("#row").val($(this).attr("data-row"));
		$("#col").val($(this).attr("data-col"));
		field.removeClass("error");
		if(this_val !== "" || this_val.length > 0) {
			$.post("php/check_current.php", $('#sudoku_inputs').serialize(), function(data){
				if(data != 0) {
					field.addClass("error");
					$(this).removeClass("selected_field");
				}
				else {
					field.removeClass("error");
					field.addClass("manual_mumber");
				}
			});
		}
		if(this_val.length === 0)
			field.removeClass("manual_mumber");
	});
	
	// Marks selected field
	$("input").focus(function() {
		$("input").each(function() {
			$(this).removeClass("selected_field");
		});
		if($(this).val() == "")
			$(this).addClass("selected_field");
	});
	
	// Solving selected
	$(".selected").click(function() {
		var selected_field = $(".selected_field");
		var row = selected_field.attr("data-row");
		var col = selected_field.attr("data-col");
		if(row == null && col == null) {
			alert("Select an empty field first");
		}
		else {
			$("#row").val(row);
			$("#col").val(col);
			$.post("php/check_selected.php", $('#sudoku_inputs').serialize(), function(data){
				alert(data);
			});
		}
	});
	
	// Resets the form
	$(".reset").click(function() {
		$("input").val("");
		$("input").removeClass("error");
		$("input").removeClass("manual_mumber");
		$("#execution_time").html("");
		$("#step_number").html("");
	});
	
	//If there are no errors, data is sent for calculation
	$(".send").click(function() {
		$('.send').prop('disabled', true);
		$('.send').addClass('submit-disabled');
		var errors = $('.error').length;
		var solution;
		var steps;
		var execution_time;
		if(errors == 0) {
			$.post("php/solve_sudoku.php", $('#sudoku_inputs').serialize(), function(data){
			$('.send').prop('disabled', false);
			$('.send').removeClass('submit-disabled');
				data = JSON.parse(data);
				if(data["solution_found"] == "0") {
					alert(data["message"]);
				}
				else {
					solution = data["matrix"];
					execution_time = data["_time"];
					for (i = 0; i < solution.length; i++) { 
						for (q = 0; q < solution[i].length; q++) { 
							$("#id_" + i + q).val(solution[i][q]);
						}
					}
					$("#execution_time").html(execution_time.toFixed(5) + " sec");
					$("#step_number").html("<b>" + data["steps"] + "</b> (Backtracking steps: <b>" + data["backs"] + "</b>; forwoad steps: <b>" + data["forwards"] + "</b>).<br> Longest streak of back steps is <b>" + data["back_max"] + "</b><br> and longest streak of forward steps is <b>" + data["forward_max"] + "</b>.");
				}
			});
		}
		else {
			alert("There are some errors\nPlease make sure there are no red fields");
			$('.send').prop('disabled', false);
			$('.send').removeClass('submit-disabled');
		}
	});
});