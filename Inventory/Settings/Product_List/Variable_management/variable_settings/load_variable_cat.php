<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';



$database_connction = database();
$json = array();

$value_seach = isset($_POST['value']) ? $_POST['value'] : "";
$sub_category_id = isset($_SESSION['sub_cat_id']) ? $_SESSION['sub_cat_id'] : NULL;

if (isset($_SESSION['sub_cat_id'])) {
    $sql_query = "select * from product_variable_category where ast='1' and sub_main_category_idsub_main_category='" . $sub_category_id . "' and name like '%" . $value_seach . "%'";
    $result = $database_connction->query($sql_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $json[] = $row;
        }
    }
}
echo json_encode($json);

