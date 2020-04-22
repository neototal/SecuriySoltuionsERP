<?php

include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/header/session_setup.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/notification/add_data.php';
include_once '../../../Imports/company/compay_loader.php';


$name = isset($_POST['name']) ? ucfirst(addslashes($_POST['name'])) : "";


$icon_url = isset($_SESSION['img_pth']) ? $_SESSION['img_pth'] : "";
//$img_state = isset($_POST['img_state']) ? $_POST['img_state'] : "0";
//echo $img_state;
$dis = isset($_POST['dis']) ? ucfirst(addslashes($_POST['dis'])) : "";
//$brand = isset($_POST['brand']) ? $brand = $_POST['brand'] : "";
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : "0";
$show_on_web = isset($_POST['show_on_web']) ? $_POST['show_on_web'] : $audit_error;
//---audit---
$audit_record_array = array();
$audit_record_array["name _value"] = $name;
$audit_record_array["name_label"] = "Main Category";
if ((isset($name) && isset($userid))) {
    setup_audit_data_new_data(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $audit_record_array);

    setup_notification_add_new_data(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $audit_record_array);

//$sql = "insert into main_category(name,icon_pic,dis,ast,sdt,user_login_iduser_login,show_in_web) values ('" . $name . "','','" . $dis . "','1',now(),'" . $userid . "','" . $show_on_web . "')";
//if ($img_state == "1") {
    $sql = "insert into main_category(name,icon_pic,dis,ast,sdt,user_login_iduser_login,show_in_web,company_list_idcompany_list) values ('" . $name . "','" . $icon_url . "','" . $dis . "','1',now(),'" . $userid . "','" . $show_on_web . "','" . $compnay_database_id . "')";
    //}

    $con = database();
    $con->query($sql);
    unset($_SESSION['img_pth']);
    echo $con->error;
} else {
    include_once '../../../Imports/audit/system_error.php';
}


include_once './image_ex_remove.php';
?>

