## Getting Started
These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.
### Prerequisites
You only need to be able to run PHP. The code is written in the 7.1.27 version, but it should work on older ones as well.
To run it, simply open the **index.php**
# How to use it
You first need to input every number that's given in the puzzle. You can navigate to the next field with tab, and to previous one with shift + tab. If everything is ok, the background color of a field will turn gray. If an inputted number can't be in that field, the background will turn to red, and you need to change the number. If there are red fields in the puzzle, you won't be able to submit the puzzle for the solution.

After you have entered all the numbers, click on the Solve button to submit the puzzle and solve it. The puzzle should fill in no time, and the solutions will be in the white fields

After puzzle has been solved, you can see the time the algorythm needed to complete the task. The time needed to send and recieve the data, and the time needed to display it is not included. You can only see time requiered to find the solution. You can also see total numbers of steps needed (in both directions), and the maximum back and forward streak (number of steps in one direction without the need to change it).

If you only need help in solving the puzzle, and if you want only one field solved, you can click on an empty field that you wish to be solved. After you click it, it will turn blue. After you've selected a field, you can click on Solve selected, and you will receive all the possible solution for the selected field. In order for this to work, you first need to select an empty field.

To empty all fields, and reset puzzle to initial state, click the Reset button. This will reset the puzzle without any previous warnings, so be careful when clicking it.
# How it works?
This Sudoku solver uses PHP for solving the puzzle, and JavaScript for comunication with PHP. It doen't use any coockies.

PHP Script is based on Backtracking algorithm. First, each field gets every possible solution for that field. And each filed is filled one at the time. If all possibilities are tested, but none work, then that field is emptied, and script returns to the previous field (backtracks). Then, input another value, and continue checking forwards
# Issues
The maximum back and forward streak (see third paragraph of How to use it) is not always correct. 
## Author
 - [Bojan Jovanoski](www.jovanoskibojan.com)
 
## Notes
 - This project is made intierly by me;
 - I apriciate any feedback you are willing to give me;
 - This project is made for a final thesis;
 - Feel free to use this code, any credits would be apriciated;
 - You can see the demo [here](http://www.ai.jovanoskibojan.com)
