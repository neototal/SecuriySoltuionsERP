<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$id_product = isset($_POST['id_product']) ? $_POST['id_product'] : "";
$search = isset($_POST['value']) ? $_POST['value'] : "";
$database_connction = database();
$json = array();
if (isset($id_product)) {
    $sql_query = "select * from product_variable_setting_drop_down where product_variable_idproduct_variable='" . $id_product . "' and value_of_dropdown like '%" . $search . "%'";
    $result = $database_connction->query($sql_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $json[]=$row;
        }
    }
} else {
    include_once '../../../../../Imports/audit/system_error.php';
}

echo json_encode($json);