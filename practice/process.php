<?php

require 'StringProcessor.php';

session_start();
$inputString = ($_GET['inputString']);

$answer = strtolower($inputString);


$stringProcessor = new StringProcessor($answer, $inputString);

/*
$isPalindrome = isPalindrome($answer);
$addVowels = addVowels($answer);
$letterShift =letterShift($inputString);*/


$_SESSION['result']  = [
    'isPalindrome' => $stringProcessor->isPalindrome(),
    'addVowels' => $stringProcessor->addVowels(),
    'letterShift' => $stringProcessor->letterShift()

];

header('Location: index.php');