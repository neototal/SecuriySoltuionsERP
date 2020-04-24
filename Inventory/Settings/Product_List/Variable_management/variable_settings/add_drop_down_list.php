<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$id_product = isset($_POST['id_product']) ? $_POST['id_product'] : "";
$value_of_data = isset($_POST['value']) ? $_POST['value'] : "";
$database_connction = database();
if (isset($id_product) && isset($userid)) {
    $sql_query = "insert into product_variable_setting_drop_down(value_of_dropdown,ast,sdt,user_login_iduser_login,product_variable_idproduct_variable) " .
            "values('" . $value_of_data . "','1',now(),'" . $userid . "','" . $id_product . "')";
    $database_connction->query($sql_query);
} else {
    include_once '../../../../../Imports/audit/system_error.php';
}
?>
