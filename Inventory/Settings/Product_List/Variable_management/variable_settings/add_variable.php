<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

//var sending_value = "id_cat=" + cat_id + "&cat_name=" + cat_name + "&data_type_id=" + type_id + "&data_type=" + data_type + "&name_of_variable=" + name_txt_obj.value +
//                    "&req=" + requard_id + "&web=" + show_on_web_id + "&invoice=" + show_on_invoice + "&estimate=" + show_on_estimate_id;



$id_cat = isset($_POST['id_cat']) ? $_POST['id_cat'] : "";
$id_data_type = isset($_POST['data_type_id']) ? $_POST['data_type_id'] : "";
$name_cat = isset($_POST['cat_name']) ? $_POST['cat_name'] : $aduit_error;
$name_data_type = isset($_POST['data_type']) ? $_POST['data_type'] : $aduit_error;
$name_of_variable = isset($_POST['name_of_variable']) ? $_POST['name_of_variable'] : $aduit_error;
$chk_req = isset($_POST['req']) ? $_POST['req'] : $aduit_error;
$chk_web = isset($_POST['web']) ? $_POST['web'] : $aduit_error;
$chk_invoice = isset($_POST['invoice']) ? $_POST['invoice'] : $aduit_error;
$chk_estimmate = isset($_POST['estimate']) ? $_POST['estimate'] : $aduit_error;
$state_of_advance = isset($_POST['state_of_advance']) ? $_POST['state_of_advance'] : $aduit_error;

$sub_category_id = isset($_SESSION['sub_cat_id']) ? $_SESSION['sub_cat_id'] : "";


if (isset($id_cat) && isset($id_data_type) && isset($userid) && isset($compnay_database_id) && isset($sub_category_id)) {
    $data_array = array();
    $data_array['name_label'] = $name_cat . " variable (" . $name_data_type . ")";
    $data_array['name_value'] = $name_of_variable;



    if (check_variable($id_cat, $id_data_type, $name_of_variable)) {
        $database_connction = database();
        $sql_query = "insert into product_variable(name,requard_state,ast,sdt,sub_main_category_idsub_main_category,user_login_iduser_login,advance_settings,type_of_variables_idtype_of_variables,show_on_web,show_on_invoice,show_on_qutation) " .
                "values('" . $name_of_variable . "','" . $chk_req . "','1',now(),'" . $sub_category_id . "','" . $userid . "','" . $state_of_advance . "','" . $id_data_type . "','" . $chk_web . "','" . $chk_invoice . "','" . $chk_estimmate . "')";
        $database_connction->query($sql_query);
        echo $database_connction->insert_id;
        echo $database_connction->error;
    }
} else {
    include_once '../../../../../Imports/audit/system_error.php';
}

function check_variable($id_cat, $id_type, $name) {
    $state = true;

    return $state;
}

?>