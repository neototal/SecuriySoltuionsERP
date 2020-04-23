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
    $sql_query = "select * from product_variable_settings_multiple where product_variable_idproduct_variable='" . $id_product . "' and ast='1'";
    $result = $database_connction->query($sql_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $json_array = array();
            $json_array['id_value'] = $row['id_value'];
            $json_array['value_of_multiple'] = $row['value_of_multiple'];
            $json_array['img_pth'] = setup_image($row['id_value']);
            array_push($json, $json_array);
        }
    }
    echo $database_connction->error;
}else{
    include_once '../../../../../Imports/audit/system_error.php';
}
echo json_encode($json);

function setup_image($id_of_setting) {
    $image_pth = "";
    $database_connction = database();
    if (isset($id_of_setting)) {
        $sql_quary = "select * from product_variable_icon_multiple where product_variable_settings_multiple_id_value='" . $id_of_setting . "' and ast='1'";
        $result = $database_connction->query($sql_quary);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $image_pth = $row['icon_pth'];
            }
        }
    }
    return $image_pth;
}
?>

