<?php
include_once ''.$pth.'Imports/header/session_setup.php';
unset($_SESSION['userid']);
header("Location: ../index.php");