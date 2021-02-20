<?php
session_start();
$inputString = ($_GET['inputString']);

$answer = strtolower($inputString);


//checks for palindrome
function isPalindrome($answer)
{
    $stringLength = str_split($answer);
    //converts variable to integer value
    $stringabc = '';

    foreach ($stringLength as $letter) {
        if ((ord($letter) >= 97) && (ord($letter) <= 122)) {
            $stringabc .= ($letter);
            
            $reverse = strrev($stringabc);


            $result = ($stringabc ==  $reverse) ? 'Yes' : 'No';
        }
    }
    return $result;
}


//counts the number of vowels
function countVowels($string)
{
    #echo(substr_count($string, 'a'));
    return substr_count($string, 'a')+ substr_count($string, 'e')+substr_count($string, 'i')+ substr_count($string, 'o')+ substr_count($string, 'u');
}

//adds the number of vowels
function addVowels($answer)
{
    $stringLength = str_split($answer);

    foreach ($stringLength as $letter) {
        $vowelCount += countVowels($letter);
    }
    return $vowelCount;
}



//shifts all letters
function letterShift($answer)
{
    $stringLength = str_split($answer);

    foreach ($stringLength as $letter) {
        if ((ord($letter) >=65) && (ord($letter) <= 122)) {
            if ((ord($letter) == 122) || (ord($letter) == 90)) {
                $newLetter = ord($letter)- 25;
            } else {
                $newLetter = ord($letter) + 1;
            }
    
            $letterShift .= chr($newLetter);
        } else {
            $letterShift .= $letter;
        }
    }
    
    #return $newLetter;
    return $letterShift;
}




$isPalindrome = isPalindrome($answer);
$addVowels = addVowels($answer);
$letterShift =letterShift($inputString);

var_dump($inputString);
var_dump($isPalindrome);

$_SESSION['result']  = [
    'isPalindrome' => $isPalindrome,
    'addVowels' => $addVowels,
    'inputString' => $inputString,
    'letterShift' => $letterShift

];

header('Location: index.php');