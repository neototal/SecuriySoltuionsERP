<?php
include_once '../../../Imports/header/session_setup.php';
$id = isset($_POST['id']) ? $_POST['id'] : $aduit_error;

$_SESSION['data_id'] = $id;
$data_check = isset($_SESSION['data_id']) ? "OK" : $aduit_error;
echo $data_check;
?>