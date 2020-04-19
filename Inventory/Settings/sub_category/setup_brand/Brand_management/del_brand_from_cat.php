<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$main_category_name = isset($_POST['main_cat']) ? $_POST['main_cat'] : "Not Found";


//"name=" + name_obj.value + "&dis=" + dis_obj.value + "&date_of_reg=" + data_obj.value + "&show_on_web_sate=" + state_of_web;

$data_array = array();
$data_array['name_label'] = $main_category_name . " to Brand";
$data_array['name_value'] = $name;

$page_id = isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $audit_error;


$main_category_id = isset($_SESSION['data_id']) ? $_SESSION['data_id'] : $audit_error;

setup_audit_data_new_data($page_id, $data_array);
setup_notification_add_new_data($page_id, $data_array);


$database_connction = database();

$barnd_last_id = isset($_POST['id']) ? $_POST['id'] : $audit_error;

//echo $last_id." last id";

if ($barnd_last_id > 0) {
    $sql_query = "update brand_info_has_main_category set ast='0' where brand_info_idbrand_info='" . $barnd_last_id . "' and main_category_idmain_category='" . $main_category_id . "'";
    $database_connction->query($sql_query);

    $sql_query = "select * from brand_info_has_main_category where brand_info_idbrand_info='" . $barnd_last_id . "' and main_category_idmain_category='" . $main_category_id . "' ";
    $result = $database_connction->query($sql_query);
    if ($result->num_rows = 0) {
        $sql_query = "update main_category set branding_state='0' where idmain_category='" . $main_category_id . "'";
        $database_connction->query($sql_query);
    }
}

echo $database_connction->error;


if (isset($_SESSION['img_pth'])) {
    unset($_SESSION['img_pth']);
}
?>