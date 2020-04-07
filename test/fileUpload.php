<?php

    session_start();
if (isset($_FILES['file'])) {
    $errors = array();
    $file_name = $_FILES['file']['name'];
    $file_size = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $file_type = $_FILES['file']['type'];
    $file_ext = strtolower(end(explode('.', $_FILES['file']['name'])));

    $extensions = array("jpeg", "jpg", "png");

    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
    }

//      if($file_size > 2097152){
//         $errors[]='File size must be excately 2 MB';
//      }
    $_SESSION['imp_pth'] = "../Imports/img/main_categories/1" . $file_name;
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "../Imports/img/main_categories/1" . $file_name);
        echo "Success";
    } else {
        print_r($errors);
    }
}
?>

