<?php

$userid=  isset($_SESSION['userid'])?$_SESSION['userid']:get_login_user_id();
//echo $userid." user id";
function get_login_user_id(){}