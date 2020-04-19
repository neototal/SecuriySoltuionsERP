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

if (!(isset($userid) || isset($main_category_id))) {
    if ($barnd_last_id > 0) {
        $sql_query = "insert into brand_info_has_main_category(brand_info_idbrand_info,main_category_idmain_category,ast,sdt) values('" . $barnd_last_id . "','" . $main_category_id . "','1',now())";
        $database_connction->query($sql_query);

        if ($database_connction->insert_id > 0) {
            $sql_update = "update main_category set branding_state='1' where idmain_category='" . $main_category_id . "'";
            $database_connction->query($sql_update);
            $database_connction->error;
        }
        echo $database_connction->error;
    }
} else {
    setup_error_msg(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $aduit_error, $_SERVER['REQUEST_URI']);
    echo "something whent wrong contact system admin";
}






if (isset($_SESSION['img_pth'])) {
    unset($_SESSION['img_pth']);
}
?>