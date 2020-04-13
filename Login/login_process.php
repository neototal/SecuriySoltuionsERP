<?php

$username = isset($_POST['us']) ? $username = $_POST['us'] : 'Not Found';
$password = isset($_POST['psw']) ? $password = $_POST['psw'] : 'Not Found';
$remember = isset($_POST['ps_ok']) ? $remember = $_POST['ps_ok'] : 'Not Found';

$LoginPageUrl="Location: ../index.php";
if ($username == 'Not Found') {
    header($LoginPageUrl.'?error=User name not found');
} else if ($password == 'Not Found') {
    header($LoginPageUrl.'?error=Password not found');
} else {
    include_once '../Imports/DB/Database_conn.php';
    $conn = database();
    $sql_query = "select * from user_login where BINARY  user_name='" . $username . "' and BINARY password='" . $password . "'";
    $result = $conn->query($sql_query);
    if ($result->num_rows > 0) {
        while($row=$result->fetch_assoc()){
            if($row['ast']=="0"){
                header($LoginPageUrl.'?error=Your account has deleted contact system administration department');
            }else if($row['account_state']=="0"){
                 header($LoginPageUrl.'?error=Your account has block contact system administration department');
            }else {
                include_once '../Imports/header/session_setup.php';
                $_SESSION['userid']=$row['iduser_login'];
                $_SESSION['empid']=$row['employee_info_idemployee_info'];
                $_SESSION['dptid']=$row['department_setup_iddepartment_setup'];
//                echo $row['iduser_login'];
                header('Location: login_system_department_process.php');
            }
        }
    }else{
        header('Location: ../index.php?error=User name or password wrong try again');
    }
}


?>