<?php

include_once '../../../../Imports/session_manager/session_setup.php';
include_once '../../../../Imports/DB/Database_conn.php';
//include_once '../../../../Imports/audit/add_data.php';
//include_once '../../../../Imports/notification/add_data.php';

$sub_id = isset($_POST['sub_id']) ? $_POST['sub_id'] : $audit_error;


$database_connction = database();
$sql_query = "select * from sub_main_category where idsub_main_category='" . $sub_id . "'";
$json = array();
$result = $database_connction->query($sql_query);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $json_result = array();
        $json_result['id'] = $row['idsub_main_category'];
        $json_result['sub_name'] = $row['name'];
        $json_result['sub_dis'] = $row['dis'];
        $json_result['show_in_web'] = $row['show_in_web'];
        $json_result = get_main_cat_name($database_connction, $row['main_category_idmain_category'],$json_result);

        array_push($json, $json_result);
    }
}
echo json_encode($json);

function get_main_cat_name($database_connction, $id_main_cat, $json_result) {
    $sql_query = "select * from main_category where idmain_category='" . $id_main_cat . "'";
    $result = $database_connction->query($sql_query);
    if ($result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            $json_result['main_cat_id'] = $row['idmain_category'];
            $json_result['main_cat_name'] = $row['name'];
            $json_result['img_path'] = $row['icon_pic'];
        }
    }
    return $json_result;
}
