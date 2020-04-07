<?php

//  var sending_value = "id=" + id + "&name=" + $("#name_update").val() + "&dis=" + $("#dis_update").val() + "&img_state=" + $("#image_state_update").val();

include_once '../../../Imports/header/session_setup.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/notification/add_data.php';



$id = isset($_POST['id']) ? $id = $_POST['id'] : "";
$name = isset($_POST['name']) ? ucfirst(addslashes($_POST['name'])) : "";
$dis = isset($_POST['dis']) ? ucfirst(addslashes($_POST['dis'])) : "";
$img_state = isset($_POST['img_state']) ? $img_state = $_POST['img_state'] : "";
$img_pth = isset($_SESSION['img_pth']) ? $img_pth = $_SESSION['img_pth'] : "";
$show_on_web = isset($_POST['show_web']) ? $_POST['show_web'] : $aduit_error;
echo $img_state;

$old_record_name = isset($_POST['old_name']) ? $old_record_name = $_POST['old_name'] : $aduit_error;
$old_record_dis = isset($_POST['old_dis']) ? $old_record_dis = $_POST['old_dis'] : $aduit_error;
$old_record_show_on_web = isset($_POST['show_web_old']) ? $old_record_show_on_web = $_POST['show_web_old'] : $aduit_error;



if ($old_record_name != $name) {
    $array_record = array();
    $array_record["name_value"] = $name;
    $array_record["name_label"] = "catergory";
    $array_record["old_name_value"] = $old_record_name;

    setup_audit_data_update(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $array_record);
} if ($old_record_dis != $dis) {
    $array_record = array();
    $array_record["name_value"] = $dis;
    $array_record["name_label"] = "description";
    $array_record["old_name_value"] = $old_record_dis;
    setup_audit_data_update(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $array_record);
}
if ($old_record_show_on_web != $show_on_web) {
    $array_record = array();
    $array_record["name_value"] = $dis;
    $array_record["name_label"] = "show on web state";

    if ($show_on_web == "1") {
        $array_record["old_name_value"] = "active";
    } else {
        $array_record["old_name_value"] = "disable";
    }

    setup_audit_data_update(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $array_record);
}
$data_array = array();
$data_array["name_value"] = $name;
$data_array["name_label"] = "catergory";
setup_notification_update_data(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found", $data_array);


//name,icon_pic,dis,ast,sdt,
$sql = "";
if ($img_state == "1") {
    $sql = "update main_category set name='" . $name . "',icon_pic='" . $img_pth . "',dis='" . $dis . "',show_in_web='" . $show_on_web . "' where idmain_category='" . $id . "'";
} else {
    $sql = "update main_category set name='" . $name . "',dis='" . $dis . "',show_in_web='" . $show_on_web . "' where idmain_category='" . $id . "'";
}
//echo $sql;
$conn = database();
$conn->query($sql);
echo $conn->error;



