<?php

//  var sending_value = "id=" + id + "&name=" + $("#name_update").val() + "&dis=" + $("#dis_update").val() + "&img_state=" + $("#image_state_update").val();

include_once '../../../Imports/header/session_setup.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/notification/add_data.php';



$id = isset($_POST['id']) ? $_POST['id'] : "";
$name = isset($_POST['name']) ? ucfirst(addslashes($_POST['name'])) : "";
$dis = isset($_POST['dis']) ? ucfirst(addslashes($_POST['dis'])) : "";
$img_old_url = isset($_POST['old_img_url']) ? $_POST['old_img_url'] : "";
$img_pth = isset($_SESSION['img_pth']) ? $_SESSION['img_pth'] : $img_old_url;
$show_on_web = isset($_POST['show_web']) ? $_POST['show_web'] : $aduit_error;


$old_record_name = isset($_POST['old_name']) ? $old_record_name = $_POST['old_name'] : $aduit_error;
$old_record_dis = isset($_POST['old_dis']) ? $old_record_dis = $_POST['old_dis'] : $aduit_error;
$old_record_show_on_web = isset($_POST['show_web_old']) ? $old_record_show_on_web = $_POST['show_web_old'] : $aduit_error;

/*
 *  var sending_value = "id=" + id + "&name=" + name.value + "&dis=" + dis.value + "&old_web_url="+old_img_url+
  "&old_name=" + old_name + "&old_dis=" + old_dis + "&show_web=" + value_of_showing_web + "&old_show_web=" + old_web_show_state;
 */

if ($old_record_name != $name) {
    $array_record = array();
    $array_record["name_value"] = $name;
    $array_record["name_label"] = "main catergory  " . $old_record_name . " name";
    $array_record["old_name_value"] = $old_record_name;

    setup_audit_data_update(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $array_record);
}
if ($old_record_dis != $dis) {
    $array_record = array();
    $array_record["name_value"] = $dis;
    $array_record["name_label"] = "main catergory " . $name . " description";
    $array_record["old_name_value"] = $old_record_dis;
    setup_audit_data_update(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $array_record);
}
if ($old_record_show_on_web != $show_on_web) {
    $array_record = array();
    $array_record["name_value"] = $dis;
    $array_record["name_label"] = "main catergory " . $name . " show on web state";

    if ($old_record_show_on_web == "1") {
        $array_record["old_name_value"] = "active";
    } else {
        $array_record["old_name_value"] = "disable";
    }
    if ($show_on_web == "1") {
        $array_record["name_value"] = "active";
    } else {
        $array_record["name_value"] = "disable";
    }

    setup_audit_data_update(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $array_record);
}

if (isset($_SESSION['img_pth'])) {
    $array_record = array();
    $array_record["name_value"] = $name;
    $array_record["name_label"] = "main catergory " . $name . " image ";
    $array_record["old_name_value"] = $old_record_name;

    setup_audit_data_update(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $array_record);
}


$data_array = array();
$data_array["name_value"] = $name;
$data_array["name_label"] = "catergory";
setup_notification_update_data(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $data_array);


//name,icon_pic,dis,ast,sdt,
$sql = "";
if (isset($_SESSION['remove_img'])) {
    $img_pth="";
}

$sql = "update main_category set name='" . $name . "',icon_pic='" . $img_pth . "',dis='" . $dis . "',show_in_web='" . $show_on_web . "' where idmain_category='" . $id . "'";

$conn = database();
$conn->query($sql);

include_once './image_ex_remove.php';
echo $conn->error;



