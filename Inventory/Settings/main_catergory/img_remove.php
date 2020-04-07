<?php

include_once '../../../Imports/session_manager/session_setup.php';

$img_pth = isset($_POST['img']) ? $_POST['img'] : "";
$remove_img = null;
if (!isset($_SESSION['remove_img'])) {
    $remove_img = array();
} else {
    $remove_img = $_SESSION['remove_img'];
}
array_push($remove_img, $img_pth);
$_SESSION['remove_img'] = $remove_img;

 print_r($remove_img);
