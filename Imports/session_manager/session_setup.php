<?php

if (!isset($_SESSION)) {
    session_start();
}
$time = $_SERVER['REQUEST_TIME'];

/**
 * for a 30 minute timeout, specified in seconds
 */
$timeout_duration = 1800;
//$timeout_duration = 1;

/**
 * Here we look for the user's LAST_ACTIVITY timestamp. If
 * it's set and indicates our $timeout_duration has passed,
 * blow away any previous $_SESSION data and start a new one.
 */
if (isset($_SESSION['LAST_ACTIVITY']) &&
        ($time - $_SESSION['LAST_ACTIVITY']) > $timeout_duration) {
    session_unset();
    session_destroy();
    session_start();
}

/**
 * Finally, update LAST_ACTIVITY so that our timeout
 * is based on it and not the user's login time.
 */
$_SESSION['LAST_ACTIVITY'] = $time;


$total_url = $_SERVER['REQUEST_URI'] . "";
$curnt_location = explode("NeoTotalSystem/", $total_url)[1];
$count = count(explode("/", $curnt_location)) - 1;
$pth = "";
for ($i = 0; $i < $count; $i++) {
    $pth = $pth . "../";
}
$_SESSION['pth']=$pth;


?>