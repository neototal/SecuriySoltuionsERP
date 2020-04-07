<?php
include_once '../../../Imports/header/session_setup.php';
include_once '../../../Imports/DB/Database_conn.php';
include_once '../../../Imports/audit/add_data.php';
include_once '../../../Imports/notification/add_data.php';

include_once '../../../Imports/company/compay_loader.php';

$id_of_main_category = isset($_SESSION['data_id']) ? $_SESSION['data_id'] : error_setup();
$vaule_of_search = isset($_POST['val']) ? $_POST['val'] : "";
$name = isset($_POST['name']) ? $_POST['name'] : $aduit_error;

$database_connction = database();
$data_array = array();
$data_array['name_label'] = "Main Category";
$data_array['name_value'] = $name;

setup_audit_data_report_view_list_view(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "Not Found", $data_array);

$sql_query = "select * from sub_main_category where main_category_idmain_category='" . $id_of_main_category . "' and ast='1' and company_list_idcompany_list='".$compnay_database_id."' order by idsub_main_category DESC";

$result = $database_connction->query($sql_query);
$json = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $json[] = $row;
    }
}


echo json_encode($json);
echo $database_connction->error;

function error_setup() {
    ?>
    <script type="text/javascript">
        window.location.replace("../Main_category.php");
    </script>
    <?php
}
?>

