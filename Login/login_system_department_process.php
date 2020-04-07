<?php

include_once '../Imports/header/session_setup.php';

include_once '../Imports/DB/Database_conn.php';


$userid = isset($_SESSION['userid']) ? ($userid = $_SESSION['userid']) : error_hendel();
$empid = isset($_SESSION['empid']) ? ($empid = $_SESSION['empid']) : error_handel();
$dptid = isset($_SESSION['dptid']) ? ($dptid = $_SESSION['dptid']) : error_handel();


if (isset($_SESSION['userid'])) {
    login_info($userid);
}

function error_handel() {
    header("Location: ../index.php?error=Something went wrong");
}

function homepange_selection($dptid, $state_of_admin, $userid) {
    $con = database();
    $sql = "select * from department_setup where iddepartment_setup='" . $dptid . "' and ast='1'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if (login_history($userid)) {
                header("Location: ../" . $row['dashbord_link']);
            } else {
                error_handel();
            }
        }
    } else {
        error_handel();
    }
}

function login_history($userid) {
    $con = database();
    $sql = "insert into login_history (sdt,ast,user_login_iduser_login) values (now(),'1','" . $userid . "')";
    return $con->query($sql);
}

function login_info($userid) {
    $con = database();
    $sql = "select * from user_login where iduser_login='" . $userid . "'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            homepange_selection($row['department_setup_iddepartment_setup'], $row['admin_state'], $userid);
            break;
        }
    }
}
