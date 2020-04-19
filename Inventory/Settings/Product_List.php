<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../Imports/session_manager/session_setup.php';
$_SESSION['title'] = "Product List";
$_SESSION['page_id'] = "000003";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include_once '../../Imports/header/basic_header.php';
        include_once '../../Imports/admin_roll_settings/roll_manager.php';
        ?>

        <script type="text/javascript">
            function settings_href() {
                window.location.href = "Product_List/Variable_management/variable_settings.php";
            }
            $(document).ready(function () {
                $("#myModal_loder").modal('show');
                set_header_info();
                load_main_body();

            });
            function set_header_info() {
                var setup_button_list = new Array();
                setup_button_list.push("New Product");
                setup_button_list.push("Setting of Variable");
                var button_list = setup_button(setup_button_list);

                button_list[0].addEventListener("click", function () {
                    alert('test');

                });
                button_list[1].addEventListener("click", function () {
                    settings_href();

                });

            }
            function load_main_body() {
                var send_value = "sub_id=<?php echo isset($_SESSION['sub_cat_id']) ? $_SESSION['sub_cat_id'] : ""; ?>";
//                alert(send_value);
                $.ajax({
                    url: "Product_List/load_sub_head.php",
                    type: 'POST',
                    data: send_value,
                    cache: false,
                    success: function (data) {
//                        alert(data);
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            load_main_body_data(json[i].id, json[i].img_path, json[i].sub_name, "Product List", json[i].sub_dis, json[i].main_cat_name, json[i].show_in_web);
                            var set_breadcrum = document.getElementById("set_breadcrum");
                            $(set_breadcrum).empty();
                            set_breadcrum.appendChild(document.createTextNode(json[i].sub_name + " Product List"));

                        }
                    }
                });

            }

        </script>
    </head>
    <body class="w3-theme-light">
        <?php
        include_once '../../Imports/menu/main_menue.php';
        ?>
        <div class="container">
            <?php include_once './setting_need/page_header.php'; ?>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb" id="breadcrumb_list">
                        <li class="breadcrumb-item">
                            <a href="Main_category.php">Main Category List</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="Sub_category.php">Sub Category List</a>
                        </li>
                        <li class="breadcrumb-item active" id="set_breadcrum">Camera Product List</li>
                    </ul>
                </div>
            </div>
        </div>


        <?php
        include_once '../../Imports/footer/footer_system.php';
        ?>
    </body>
</html>
