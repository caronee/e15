<?php

require 'StringProcessor.php';

session_start();
$inputString = ($_GET['inputString']);

$answer = strtolower($inputString);

$xyz = StringProcessor::xyz();
$stringProcessor = new StringProcessor($answer, $inputString);

/*
$isPalindrome = isPalindrome($answer);
$addVowels = addVowels($answer);
$letterShift =letterShift($inputString);*/



$_SESSION['result']  = [
    'isPalindrome' => $stringProcessor->isPalindrome(),
    'addVowels' => $stringProcessor->addVowels(),
    'letterShift' => $stringProcessor->letterShift(),
    'inputString' => $inputString,
    'answer' => $answer

];

header('Location: index.php');