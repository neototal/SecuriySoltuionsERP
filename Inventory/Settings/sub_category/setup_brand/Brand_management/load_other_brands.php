<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$database_connction = database();
$main_category_id = isset($_SESSION['data_id']) ? $_SESSION['data_id'] : $audit_error;

$sql_query = "select * from brand_info where ast='1' and idbrand_info in(select DISTINCT brand_info_idbrand_info from brand_info_has_main_category where ast='1' and main_category_idmain_category='" . $main_category_id . "')";
$json = array();
$result = $database_connction->query($sql_query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $json[] = $row;
    }
}
echo json_encode($json);

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

