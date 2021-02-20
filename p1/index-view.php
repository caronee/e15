<!DOCTYPE html>
<html lang='en'>

<head>

    <title>Project 1</title>
    <meta charset='utf-8'>
    <style>
    h1 {
        color: darkblue;
    }

    .container {
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        width: 50%;
        font-family: Arial, Helvetica, sans-serif;
    }
    </style>


</head>

<body>

    <div class='container'>

        <h1>String Processor - e15 Project 1</h1>
        <form method='GET' action='process.php'>

            <label for='inputString'>Enter a string</label>
            <input type='text' id='inputString' name='inputString'>

            <button type='submit'>Submit</button>
        </form>

        <?php if (isset($inputString)): ?>
        <h2>String:</h2>
        <?php echo $inputString; ?>
        <h2>Is Palindrome?</h2>
        <?php echo $isPalindrome; ?>
        <h2>Vowel Count</h2>
        <?php echo $addVowels;?>

        <h2>Letter Shift</h2>
        <?php echo $letterShift; ?>



        <?php endif ?>

    </div>


</body>

</html>