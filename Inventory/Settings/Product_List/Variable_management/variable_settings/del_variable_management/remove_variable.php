<?php

include_once '../../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../../Imports/audit/add_data.php';
include_once '../../../../../../Imports/notification/add_data.php';
include_once '../../../../../../Imports/company/compay_loader.php';
include_once '../../../../../../Imports/admin_roll_settings/user.php';

$get_id = isset($_POST['id']) ? $_POST['id'] : "0";

$database_connction = database();

if (isset($get_id)) {
    $sql_query = "update product_variable set ast='0' where idproduct_variable='" . $get_id . "'";
    if ($database_connction->query($sql_query) === TRUE) {
        echo 'ok';
    } else {
        echo'something went wrong try again';
    }
}
