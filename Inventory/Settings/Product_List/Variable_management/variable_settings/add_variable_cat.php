<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$variable_cat = isset($_POST['name']) ? capitalize($_POST['name']) : "";
$sub_category_id = isset($_SESSION['sub_cat_id']) ? $_SESSION['sub_cat_id'] : $aduit_error;
$sub_category_name = isset($_POST['s_val_name']) ? $_POST['s_val_name'] : "not found";
$page_id = isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $audit_error;



if ((isset($variable_cat) || isset($userid) || isset($sub_category_id) || isset($compnay_database_id))) {
    $data_array = array();
    $data_array['name_label'] = $sub_category_name . " setting for variable category";
    $data_array['name_value'] = $variable_cat;

    setup_audit_data_new_data($page_id, $data_array);

    if (check_variable_cat($variable_cat)) {
        $database_connction = database();
        $sql_query = "insert into product_variable_category(name,ast,sdt,user_login_iduser_login,sub_main_category_idsub_main_category,company_list_idcompany_list)" .
                " values('" . $variable_cat . "','1',now(),'" . $userid . "','" . $sub_category_id . "','" . $compnay_database_id . "')";

        $database_connction->query($sql_query);
//        $_SESSION['variable_cat_id'] = $database_connction->insert_id;
        echo $database_connction->insert_id;
        echo $database_connction->error;
    } else {
        echo 'Already have add this data';
    }
} else {
    include_once '../../../../../Imports/audit/system_error.php';
}

function check_variable_cat($value_to_check) {
    $return_value = false;
    $database_conntion = database();
    $sql_quary = "select * from product_variable_category where name='" . $value_to_check . "'";
    $result = $database_conntion->query($sql_quary);
    if ($result->num_rows == 0) {
        $return_value = true;
    }


    return$return_value;
}
