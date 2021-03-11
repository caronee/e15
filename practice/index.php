<?php

session_start();

$inputString = null;
#var_dump($_SESSION);



if (isset($_SESSION['result'])) {
    extract($_SESSION['result']);


    $_SESSION['result'] = null;
}

require 'index-view.php';