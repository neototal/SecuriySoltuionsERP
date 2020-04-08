<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../../../Imports/session_manager/session_setup.php';
$_SESSION['title'] = "Branding Management";
$_SESSION['page_id'] = "03_01_01";
?>


<html>
    <head>
        <meta charset="UTF-8">

        <?php
        include_once '../../../../Imports/header/basic_header.php';
        include_once '../../../../Imports/admin_roll_settings/roll_manager.php';
        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#myModal_loder").modal('show');
                load_data();
                setup_header();
            });

            function setup_header() {
                var setup_button_name = new Array();
                setup_button_name.push("Add New Brand");
                var get_button_list = setup_button(setup_button_name);
                get_button_list[0].addEventListener("click", function () {
                    alert('test');
                });
                var search = document.getElementById("search_value");
                search.addEventListener("keydown", function () {
                });

                var search_btn = document.getElementById("search_value_btn");
                search_btn.addEventListener("click", function () {
                });
            }

            function load_data() {
                $.ajax({
                    url: "../load_main_catergory_data.php",
                    type: 'POST',
                    cache: false,
                    success: function (data) {
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            load_main_body_data(json[i].id, json[i].icon_pic, json[i].name, "Register Brand List", json[i].dis, "", json[i].show_in_web);
                            var set_breadcrum = document.getElementById("set_breadcrum");
                            $(set_breadcrum).empty();
                            set_breadcrum.appendChild(document.createTextNode(json[i].name + " Register Brand List"));
                        }


                    }

                });
            }
        </script>
    </head>
    <body class="w3-theme-light">
        <?php
        include_once '../../../../Imports/menu/main_menue.php';
        ?>
        <div class="container">
            <?php include_once '../../setting_need/page_header.php'; ?>
            <div class="row w3-margin-bottom">
                <div class="col-lg-12 col-sm-12">
                    <ul class="breadcrumb" id="breadcrumb_list">
                        <li class="breadcrumb-item"><a href="../../Main_category.php">Main Category List</a></li>
                        <li class="breadcrumb-item"><a href="../../Sub_category.php">Sub Category List</a></li>
                        <li class="breadcrumb-item active" id="set_breadcrum">Main Category Brand List</li>
                    </ul>
                </div>
            </div>

            <div class="container w3-padding-16  w3-round w3-theme-l4 w3-card" id="body_table">
                <div class="row w3-border-bottom w3-border-top w3-border-theme w3-padding">
                    <div class="col-lg-4">
                        <img src="../../../../Imports/img/Brands/dahu.png" style="width: 100%;">
                    </div>
                    <div class="col-lg-6">
                        <strong> Neo Total Security Solutions </strong>
                        <p> Neo Total Security Solutions Neo Total Security Solutions Neo Total Security Solutions</p>
                        <p class="w3-text-red">Start date : 2015</p>
                        <span class="w3-text-red">Show on main web state deactive</span>
                    </div>
                    <div class="col-lg-1 w3-padding w3-tooltip">
                        <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                        <span class="w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center">Open</span>
                    </div>
                    <div class="col-lg-1 w3-padding">
                        <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                    </div>

                </div>
            </div>
        </div>

        <?php
        include_once '../../../../Imports/footer/footer_system.php';
        ?>
    </body>
</html>
