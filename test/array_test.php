<?php

$cars = array();

$car_1=array();
$car_1["a"]="1";
$car_1["b"]="2";



print_r( $car_1);
echo '<br>';
echo $car_1['a'];

session_start();
//$_SESSION['page_id']="cdtgnyi,o.l/p.,munybtvrcew";
echo '------------------------------';
echo isset($_SESSION['page_id'])?$_SESSION['page_id']:"not found";

unset($_SESSION['page_id']);


echo '----------------------<br>';
echo (int)microtime(true);;