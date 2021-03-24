<?php

session_start();

$inputString = null;




if (isset($_SESSION['result'])) {
    //var_dump($_SESSION);

    extract($_SESSION['result']);


    $_SESSION['result'] = null;
}

require 'index-view.php';