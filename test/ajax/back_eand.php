<?php

$name = isset($_POST['name']) ? $_POST['name'] : "";
$city = isset($_POST['city']) ? $_POST['city'] : "";
$app = isset($_POST['app']) ? $_POST['app'] : "";

$name_02 = isset($_GET['test']) ? $_GET['test'] : "";
echo $name . " - " . $city." - ".$app." - ".$name_02;
