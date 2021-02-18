<?php

# Define 4 different variables, which will
# each represent how much a given coin is worth
$penny_value = .01;
$nickel_value = .05;
$dime_value = .10;
$quarter_value = .25;

# Define 4 more variables, which will each
# represent how many of each coin is in the bank
$pennies = 100;
$nickels = 25;
$dimes = 100;
$quarters = 34;

# Add up how much money is in the piggy bank
$total = ($pennies * $penny_value) + ($nickels * $nickel_value) + ($dimes * $dime_value) + ($quarters * $quarter_value);

require 'bank-view.php';

?>
