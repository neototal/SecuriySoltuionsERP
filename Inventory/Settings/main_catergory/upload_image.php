<?php
$time_stamp_id = (int) microtime(true) . "";
if (is_array($_FILES)) {
    if (is_uploaded_file($_FILES['userImage']['tmp_name'])) {
        $sourcePath = $_FILES['userImage']['tmp_name'];
        $targetPath = "../../../Imports/img/main_categories/" . $time_stamp_id . $_FILES['userImage']['name'];
        $file_name = $time_stamp_id . $_FILES['userImage']['name'];
//echo $sourcePath. "  ---  ".$targetPath;
        if (move_uploaded_file($sourcePath, $targetPath)) {
            include_once '../../../Imports/header/session_setup.php';

            $_SESSION['img_pth'] = "Imports/img/main_categories/" . $file_name;
            $file_name = "../../Imports/img/main_categories/" . $file_name;
            ?>
            <img class="image-preview" src="<?php echo $file_name; ?>" class="upload-preview" />
            <?php
        }
    }
}
?>