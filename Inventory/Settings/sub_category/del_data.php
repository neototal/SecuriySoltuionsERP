<?php

include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/session_manager/session_setup.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/notification/add_data.php';

$id = isset($_POST['id']) ? $_POST['id'] : $aduit_error;
$name = isset($_POST['name']) ? $_POST['name'] : $aduit_error;

$main_category = isset($_POST['main_name']) ? $_POST['main_name'] : $aduit_error;

$page_id = isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $aduit_error;

$data_array=array();
$data_array['name_label']=$main_category." of sub category ";
$data_array['name_value']=$name;

setup_audit_data_del($page_id, $data_array);
setup_notification_del_data($page_id, $data_array);

$sql_query = "update sub_main_category set ast='0' where idsub_main_category='" . $id . "'";
$database_connction = database();
$database_connction->query($sql_query);



