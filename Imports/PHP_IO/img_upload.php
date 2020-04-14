<?php

unset($_SESSION['img_pth']);
$time_stamp_id = (int) microtime(true) . "_img_id_over_";
$dir_name=isset($_SESSION['upload_dir'])?$_SESSION['upload_dir']:"error";
$file_real_pth = $pth . "Imports/img/".$dir_name."/" . $time_stamp_id;
$file_DB_save_pth = "Imports/img/".$dir_name."/" . $time_stamp_id;
//echo $file_real_pth."  ".$file_DB_save_pth."  befor upload<br>";
if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $sourcePath = $_FILES['userImage']['tmp_name'];
        $targetPath = $file_real_pth . $_FILES['userImage']['name'];
        if (move_uploaded_file($sourcePath, $targetPath)) {
            $file_DB_save_pth = $file_DB_save_pth . $_FILES['userImage']['name'];
        }
    }
}
$_SESSION['img_pth'] = $file_DB_save_pth;
echo $file_DB_save_pth;
