<?php

include_once $pth . 'Imports/session_manager/session_setup.php';

$compnay_database_id = isset($_SESSION['company_id']) ? $_SESSION['company_id'] : load_data();

function load_data() {
    $_SESSION['company_id'] = "1";
}
