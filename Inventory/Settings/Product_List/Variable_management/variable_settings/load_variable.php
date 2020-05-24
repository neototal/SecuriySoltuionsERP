<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$id_cat = isset($_POST['cat_id']) ? $_POST['cat_id'] : NULL;
$search_value = isset($_POST['search_val']) ? $_POST['search_val'] : "";

$json=array();
if (isset($id_cat)) {
    $database_connction = database();
    $sql_query="";
    if(isset($search_value)){
        $sql_query = "select * from product_variable where product_variable_category_idproduct_variable_category='" . $id_cat . "' and ast='1' and name like '%.$search_value.%'";
    }else {
        $sql_query = "select * from product_variable where product_variable_category_idproduct_variable_category='" . $id_cat . "' and ast='1";
    }
//echo $sql_query."   test line check--- ";
    $result = $database_connction->query($sql_query);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $json_array=array();
            $json_array['idproduct_variable']=$row['idproduct_variable'];
            $json_array['name']=$row['name'];
            $json_array['data_type']=  get_data_type($row['type_of_variables_idtype_of_variables']);
            array_push($json, $json_array);
        }
    }
}else{
    include_once '../../../../../Imports/audit/system_error.php';
}

echo json_encode($json);

function get_data_type($id_type) {
    $sending_value = "";
    $database_connction = database();
    $sql_quary = "select * from type_of_variables where idtype_of_variables='" . $id_type . "'";
    $result = $database_connction->query($sql_quary);
    if ($result->num_rows > 0) {
        if ($row = $result->fetch_assoc()) {
            $sending_value=$row['name'];
        }
    }

    return $sending_value;
}
