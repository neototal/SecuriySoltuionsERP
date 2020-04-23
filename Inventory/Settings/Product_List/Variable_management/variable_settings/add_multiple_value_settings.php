<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$id_product = isset($_POST['id_product']) ? $_POST['id_product'] : "";
$name_of_value = isset($_POST['value']) ? $_POST['value'] : "";

if (isset($id_product) && isset($name_of_value) && isset($userid) && isset($compnay_database_id)) {
    $database_connction = database();
    $icon_state = isset($_SESSION['img_pth']);
    $sql_query = "insert into product_variable_settings_multiple(value_of_multiple,ast,sdt,user_login_iduser_login,product_variable_idproduct_variable,icon_state)" .
            " values('" . $name_of_value . "','1',now(),'" . $userid . "','" . $id_product . "','" . $icon_state . "')";

    $database_connction->query($sql_query);
    $last_id = $database_connction->insert_id;

    if ($icon_state) {
        if ($last_id != 0) {
            $image_path = isset($_SESSION['img_pth']) ? $_SESSION['img_pth'] : "";
            $sql_query = "insert into product_variable_icon_multiple(icon_pth,ast,sdt,user_login_iduser_login,product_variable_settings_multiple_id_value) values('" . $image_path . "','1',now(),'" . $userid . "','" . $last_id . "')";
            $database_connction->query($sql_query);
        }
    }
} else {
    include_once '../../../../../Imports/audit/system_error.php';
}




