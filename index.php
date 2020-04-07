<!DOCTYPE html>
<?php
include './Imports/header/session_setup.php';

$_SESSION['pth'] = "";
$error_msg = isset($_GET['error']) ? $error_msg = $_GET['error'] : '';


?>

<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="windows-1252">

        <?php
        $_SESSION['title'] = "Login";
        include_once  './Imports/header/basic_header.php';
        ?>
        <style type="text/css">
            html, body {
                height: 100%;
            }
        </style>
    </head>
    <body class="w3-theme-l5">
        <div class="container">
            <div class="row w3-margin-bottom">
                <div class="col-lg-4 ">
                    <img src="Imports/img/finalLogo.png" class="w3-img" style="width: 50%;">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-7 hidden-md hidden-sm">
                    <div class="container-fluid">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8 w3-margin">
                            <center>
                                <img src="Imports/img/login/sign-in-boulder-vfl2oGV4v.png">
                            </center>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-8 col-sm-8">
                    <h2>Sign In</h2>
                    <hr>
                    <form class="w3-container" action="Login/login_process.php" method="POST">
                        <div class="w3-section">
                            <label><b>Username</b></label>
                            <input autocomplete="off" class="w3-input w3-border w3-margin-bottom" type="text"  placeholder="Enter Username" name="us" required>
                            <label><b>Password</b></label>
                            <input class="w3-input w3-border" autocomplete="off" type="text" placeholder="Enter Password" name="psw" required>
                            <button class="w3-button w3-block w3-theme-d5 w3-section w3-padding" type="submit">Login</button>
                            <input class="w3-check w3-margin-top" name="ps_ok" type="checkbox" checked="checked" hidden>
                            <!--Remember me-->
                        </div>
                    </form>
                    <center> <p class="w3-text-red"><b><?php echo $error_msg; ?></b></p></center>
                </div>

            </div>
        </div>
        <?php include_once './Imports/footer/footer_system.php'; ?>
    </body>
</html>
