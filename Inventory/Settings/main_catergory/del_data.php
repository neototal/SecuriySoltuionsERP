<?php
include_once '../../../Imports/session_manager/session_setup.php';
include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/notification/add_data.php';

$id = isset($_POST['id']) ? $id = $_POST['id'] : $aduit_error;
$name = isset($_POST['name']) ? $name = $_POST['name'] : $aduit_error;

//---audit---
$data_array = array();
$data_array["name_label"] = "Category";
$data_array["name_value"] = $name;

setup_audit_data_del(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $data_array);
//---notification---
setup_notification_del_data(isset($_SESSION['page_id'])?$_SESSION['page_id']:"not found", $data_array);

$sql = "update main_category set ast='0' where idmain_category='" . $id . "'";



$conn = database();

echo $conn->query($sql);
?>