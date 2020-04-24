<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';


$database_connction = database();
$sql_query = "select * from type_of_variables where ast='1'";
$result = $database_connction->query($sql_query);
$json = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($json, $row);
    }
} else {
    add_new();
}

echo json_encode($json);
function add_new() {
    $database_connction = database();
    $sql_query_array = array();
    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('1', 'Number Fromat', '1', now(), '0')");
    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('2', 'Small Text Fromat', '1', now(), '0')");
    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('3', 'Large Text Fromat', '1', now(), '0')");
    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('4', 'Yes / No', '1', now(), '0')");
    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('5', 'Multiple Selections', '1', now(), '1')");
    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('6', 'Drop Down List', '1', now(), '1')");
//    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('7', 'Upload Files', '1', now(), '1')");
//    array_push($sql_query_array, "INSERT INTO `type_of_variables` VALUES ('8', 'Date Types', '1', now(), '0')");

    for ($i = 0; $i < count($sql_query_array); $i++) {
        $database_connction->query($sql_query_array[$i]);
    }
//    print_r($sql_query_array);
}


?>