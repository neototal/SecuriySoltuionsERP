<?php

include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/header/session_setup.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/notification/add_data.php';



// var sending_value = "id=" + id + "&old_name=" + old_name + "&old_dis=" + old_dis + "&old_show_on_web=" + old_show_on_web +
//                    "&name=" + $("#name_update").val() + "&dis=" + $("#dis_update").val() + "&show_on_web=" + show_on_web_state;
//"&main_cat_name="+document.getElementById("sub_main_cat_name").innerHTML;
$id = isset($_POST['id']) ? $_POST['id'] : $audit_error;

$old_name = isset($_POST['old_name']) ? $_POST['old_name'] : $audit_error;
$old_dis = isset($_POST['old_dis']) ? $_POST['old_dis'] : $audit_error;
$old_show_on_web = isset($_POST['old_show_on_web']) ? $_POST['old_show_on_web'] : $audit_error;

$name = isset($_POST['name']) ? ucfirst(addslashes($_POST['name'])) : $audit_error;
$dis = isset($_POST['dis']) ?ucfirst(addslashes($_POST['dis'])): $audit_error;
$show_on_web = isset($_POST['show_on_web']) ? $_POST['show_on_web'] : $audit_error;

$update_name = isset($_POST['main_cat_name']) ? $_POST['main_cat_name'] : $audit_error;

$page_id = isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $audit_error;

if ($old_name != $name) {
    $data_array = array();
    $data_array['name_label'] = $update_name . " main category name";
    $data_array['name_value'] = $name;
    setup_audit_data_update($page_id, $data_array);
}
if ($old_dis = $dis) {
    $data_array = array();
    $data_array['name_label'] = $update_name . " main category description";
    $data_array['name_value'] = $dis;
    setup_audit_data_update($page_id, $data_array);
}
if ($old_show_on_web = $show_on_web) {
    $data_array = array();
    $data_array['name_label'] = $update_name . " main category web seates";
    if ($show_on_web == "0") {
        $data_array['name_value'] = "deactive";
    } else {
        $data_array['name_value'] = "active";
    }
    setup_audit_data_update($page_id, $data_array);
}

$data_array = array();
$data_array['name_label'] = $update_name . " main category name";
$data_array['name_value'] = $name;

setup_notification_update_data($page_id, $data_array);

$sql_query = "update sub_main_category set name='" . $name . "',dis='" . $dis . "',show_in_web='" . $show_on_web . "' where idsub_main_category='" . $id . "'";
$database_connction = database();
echo $database_connction->query($sql_query);
echo $database_connction->error;
?>
