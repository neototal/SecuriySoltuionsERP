<?php

include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/header/session_setup.php';
include_once '../../../Imports/notification/add_data.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/company/compay_loader.php';

$id_of_main_category = isset($_SESSION['data_id']) ? $_SESSION['data_id'] : error_response();
$userid = isset($_SESSION['userid']) ? $_SESSION['userid'] : error_response();

$main_category_name = isset($_POST['main_name']) ? ucfirst($_POST['main_name']) : $aduit_error;
$name = isset($_POST['name']) ? ucfirst(addslashes($_POST['name'])) : $aduit_error;
$dis = isset($_POST['dis']) ? ucfirst(addslashes($_POST['dis'])) : $aduit_error;
$show_on_web = isset($_POST['show_on_web']) ? $_POST['show_on_web'] : $aduit_error;

$data_array = array();
$data_array['name_label'] = $main_category_name . " of sub category ";
$data_array['name_value'] = $name;

setup_notification_add_new_data(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $aduit_error, $data_array);
setup_notification_add_new_data(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $aduit_error, $data_array);


$sql_query = "insert into sub_main_category(name,dis,show_in_web,main_category_idmain_category,user_login_iduser_login,sdt,ast,company_list_idcompany_list) "
        . "values('" . $name . "','" . $dis . "','" . $show_on_web . "','" . $id_of_main_category . "','" . $userid . "',now(),'1','".$compnay_database_id."')";
$database_connction = database();
echo $database_connction->query($sql_query);

echo $database_connction->error;

function error_response() {
    
}
?>


