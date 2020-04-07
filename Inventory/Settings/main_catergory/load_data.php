<?php

include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/notification/add_data.php';
include_once '../../../Imports/session_manager/session_setup.php';

include_once '../../../Imports/company/compay_loader.php';

$value = isset($_POST['value']) ? $_POST['value'] : "";

$sql = "select * from main_category where name like '%" . $value . "%' and ast='1' and company_list_idcompany_list='".$compnay_database_id."'  order by idmain_category DESC";

setup_audit_data_report_view_list_view(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "not found");

$json = array();
$conn = database();
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $json[] = $row;
    }
}
unset($_SESSION['img_pth']);
echo json_encode($json);
?>

