<?php

include_once '../../../Imports/session_manager/session_setup.php';
unset($_SESSION['img_pth']);
$time_stamp_id = (int) microtime(true) . "_img_id_over_";
if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $sourcePath = $_FILES['userImage']['tmp_name'];
        $targetPath = "../../../Imports/img/main_categories/" . $time_stamp_id . $_FILES['userImage']['name'];
        $file_name = $time_stamp_id . $_FILES['userImage']['name'];
//echo $sourcePath. "  ---  ".$targetPath;
        if (move_uploaded_file($sourcePath, $targetPath)) {


            $_SESSION['img_pth'] = "Imports/img/main_categories/" . $file_name;
            $file_name = "Imports/img/main_categories/" . $file_name;
            echo $file_name;
        }
    }
}
?>