<?php


class StringProcessor
{
    #properties
    private $answer; //property
    private $inputString;

    #methods - things that properties can do
    public function __construct($answer, $inputString)
    {
        $this->answer = $answer; //sets property
        $this->inputString = $inputString;
        var_dump($this->answer, $this->inputString);
    }


    //checks for palindrome
    public function isPalindrome()
    {
        var_dump($this->answer);

        $stringLength = str_split($this->answer);
        
        //converts variable to integer value
        $stringabc = '';

        foreach ($stringLength as $letter) {
            if ((ord($letter) >= 97) && (ord($letter) <= 122)) {
                $stringabc .= ($letter);
            
                $reverse = strrev($stringabc);


                $result = ($stringabc ==  $reverse) ? 'Yes' : 'No';
            }
        }
        //echo($result);
        return $result;
    }


    //counts the number of vowels
    public function countVowels($string)
    {
        #echo(substr_count($string, 'a'));
        return substr_count($string, 'a')+ substr_count($string, 'e')+substr_count($string, 'i')+ substr_count($string, 'o')+ substr_count($string, 'u');
    }

    //adds the number of vowels
    public function addVowels()
    {
        $stringLength = str_split($this->answer);

        foreach ($stringLength as $letter) {
            $vowelCount += $this->countVowels($letter);
        }
        return $vowelCount;
    }



    //shifts all letters
    public function letterShift()
    {
        $stringLength = str_split($this->inputString);

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
}