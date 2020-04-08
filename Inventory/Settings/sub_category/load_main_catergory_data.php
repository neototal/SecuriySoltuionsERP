<?php

include_once '../../../Imports/header/session_setup.php';
include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/notification/add_data.php';

$main_category_id = isset($_SESSION['data_id']) ? $_SESSION['data_id'] : error_send_();
//$name_of_search = isset($_SESSION['val']) ? $_SESSION['val'] : "";

$database_connction = database();
$sql_query = "select * from main_category where idmain_category='" . $main_category_id . "' ";
$result = $database_connction->query($sql_query);
$json = array();
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $json[] = $row;
    }
}
echo json_encode($json);

function error_send_() {
    
}
?>

