<?php

include_once '../../../Imports/session_manager/session_setup.php';
if (isset($_SESSION['sub_cat_id'])) {
    unset($_SESSION['sub_cat_id']);
}
$sub_category_id = isset($_POST['sub_cat_id']) ? $_POST['sub_cat_id'] : "";

$_SESSION['sub_cat_id'] = $sub_category_id;
if (isset($_SESSION['sub_cat_id'])) {
    echo 'ok';
} else {
    echo 'not found';
}
