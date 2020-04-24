<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';


$database_connction = database();
$sql_query = "select * from product_variable where advance_settings='1' and  ast='1'";

$result = $database_connction->query($sql_query);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        if (get_data_type($row['type_of_variables_idtype_of_variables']) == "Multiple Selections") {
            multiple_selections_settings($row['idproduct_variable']);
        } else if (get_data_type($row['type_of_variables_idtype_of_variables']) == "Drop Down List") {
            drop_down_list_settings($row['idproduct_variable']);
        }
    }
}

function get_data_type($id_type) {
    
}

function multiple_selections_settings($id_of_product_variable) {
    
}

function drop_down_list_settings($id_of_product_variable) {
    
}

function delete_variable($id_of_prduct_variable){}
