<?php


$root = $_SERVER['DOCUMENT_ROOT'] . "/NeoTotalSystem/";

$url = "";

$img_list_array = isset($_SESSION['remove_img']) ? $_SESSION['remove_img'] : array();

if (count($img_list_array) != 0) {
    echo "<br>".count($img_list_array)."<br>";
    for ($i = 0; $i < count($img_list_array); $i++) {
        unlink($root . $img_list_array[$i]);
        echo $img_list_array[$i];
    }
    unset($_SESSION['remove_img']);
}
