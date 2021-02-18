<?php


function isPalindrome($inputString)
{
   $revString =  strrev (inputString);
    echo $revString;
    return ( $revString == "hello" );
        
        
}

$inputString = 'hello';

$isPalindrome = isPalindrome($inputString);

$letter_array = ['a', 'z'];


asort($letter_array);

var_dump($letter_array);

require 'index-view.php';