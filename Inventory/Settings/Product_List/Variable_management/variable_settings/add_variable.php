<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

//var sending_value = "id_cat=" + cat_id + "&cat_name=" + cat_name + "&data_type_id=" + type_id + "&data_type=" + data_type + "&name_of_variable=" + name_txt_obj.value +
//                    "&req=" + requard_id + "&web=" + show_on_web_id + "&invoice=" + show_on_invoice + "&estimate=" + show_on_estimate_id;

$aduit_error="";


$id_cat = isset($_POST['id_cat']) ? $_POST['id_cat'] : $aduit_error;
$id_data_type = isset($_POST['data_type_id']) ? $_POST['data_type_id'] : $aduit_error;
$name_cat = isset($_POST['cat_name']) ? $_POST['cat_name'] : $aduit_error;
$name_data_type = isset($_POST['data_type']) ? $_POST['data_type'] : $aduit_error;
$name_of_variable = isset($_POST['name_of_variable']) ? $_POST['name_of_variable'] : $aduit_error;
$chk_req = isset($_POST['req']) ? $_POST['req'] : $aduit_error;
$chk_web = isset($_POST['web']) ? $_POST['web'] : $aduit_error;
$chk_invoice = isset($_POST['invoice']) ? $_POST['invoice'] : $aduit_error;
$chk_estimmate = isset($_POST['estimate']) ? $_POST['estimate'] : $aduit_error;


$data_array=array();
$data_array['name_label']=$name_cat." variable (".$name_data_type.")";
$data_array['name_value']=$name_of_variable;

?>