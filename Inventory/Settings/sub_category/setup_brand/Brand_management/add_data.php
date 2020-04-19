<?php

include_once '../../../../../Imports/DB/Database_conn.php';
include_once '../../../../../Imports/session_manager/session_setup.php';
include_once '../../../../../Imports/audit/add_data.php';
include_once '../../../../../Imports/notification/add_data.php';
include_once '../../../../../Imports/company/compay_loader.php';
include_once '../../../../../Imports/admin_roll_settings/user.php';

$main_category_name = isset($_POST['main_cat']) ? $_POST['main_cat'] : "Not Found";


//"name=" + name_obj.value + "&dis=" + dis_obj.value + "&date_of_reg=" + data_obj.value + "&show_on_web_sate=" + state_of_web;

$name = isset($_POST['name']) ? capitalize($_POST['name']) : $audit_error;
$dis = isset($_POST['dis']) ? capitalize($_POST['dis']) : "";
$date_of_reg = isset($_POST['date_of_reg']) ? $_POST['date_of_reg'] : "";
$show_on_web = isset($_POST['show_on_web_sate']) ? $_POST['show_on_web_sate'] : $audit_error;

$img_pth = isset($_SESSION['img_pth']) ? $_SESSION['img_pth'] : "";

$data_array = array();
$data_array['name_label'] = $main_category_name . " to Brand";
$data_array['name_value'] = $name;

$page_id = isset($_SESSION['page_id']) ? $_SESSION['page_id'] : $audit_error;


$main_category_id = isset($_SESSION['data_id']) ? $_SESSION['data_id'] : $audit_error;


if ((isset($name) || isset($main_category_id)||isset($userid))) {
    setup_audit_data_new_data($page_id, $data_array);
    setup_notification_add_new_data($page_id, $data_array);

    if (check_brand_availbe($name)) {
        $database_connction = database();

        $sql_query = "insert into brand_info(show_on_web,brand_name,icon_pth,since_date,ast,sdt,user_login_iduser_login,company_list_idcompany_list) values('" . $show_on_web . "','" . $name . "','" . $img_pth . "','" . $date_of_reg . "','1',now(),'" . $userid . "','" . $compnay_database_id . "')";
        $database_connction->query($sql_query);


        $barnd_last_id = $database_connction->insert_id;

//echo $last_id." last id";

        if ($barnd_last_id > 0) {
            $sql_query = "insert into brand_info_has_main_category(brand_info_idbrand_info,main_category_idmain_category,ast,sdt) values('" . $barnd_last_id . "','" . $main_category_id . "','1',now())";
            $database_connction->query($sql_query);

            if ($database_connction->insert_id > 0) {
                $sql_update = "update main_category set branding_state='1' where idmain_category='" . $main_category_id . "'";
                $database_connction->query($sql_update);
                $database_connction->error;
            }
            echo $database_connction->error;
        }

        echo $database_connction->error;
    } else {
        echo 'Already has save the reocrd ';
    }
} else {
    include_once '../../../../../Imports/audit/system_error.php';
}

function check_brand_availbe($brand_name) {
    $state_of_brand = true;
    $database_conncetion = database();

    $sql_query = "select * from brand_info where brand_name='" . $brand_name . "'";
    $result = $database_conncetion->query($sql_query);
    if ($result->num_rows > 0) {
        $state_of_brand = false;
    }


    return $state_of_brand;
}

unset($_SESSION['img_pth']);
?>