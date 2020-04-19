<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../../../Imports/session_manager/session_setup.php';
$_SESSION['title'] = "Product Setting Stage 01";
$_SESSION['page_id'] = "000003_0001";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include_once '../../../../Imports/header/basic_header.php';
        include_once '../../../../Imports/admin_roll_settings/roll_manager.php';
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
                setup_button_list.push("New Variable");
//                setup_button_list.push("Preview Form");

                var button_list = setup_button(setup_button_list);

                button_list[0].addEventListener("click", function () {
                    add_variable();

                });


            }
            function load_main_body() {
                var send_value = "sub_id=<?php echo isset($_SESSION['sub_cat_id']) ? $_SESSION['sub_cat_id'] : ""; ?>";
                //                alert(send_value);
                $.ajax({
                    url: "../load_sub_head.php",
                    type: 'POST',
                    data: send_value,
                    cache: false,
                    success: function (data) {
//                        alert(data);
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            load_main_body_data(json[i].id, json[i].img_path, json[i].sub_name, "Variable Settings", json[i].sub_dis, json[i].main_cat_name, json[i].show_in_web);
                            var set_breadcrum = document.getElementById("set_breadcrum");
//                            alert(json[i].sub_name);
                            $(set_breadcrum).empty();
                            set_breadcrum.appendChild(document.createTextNode(json[i].sub_name + " Product List"));

                        }
                    }
                });

            }

        </script>
    </head>
    <body>
        <?php
        include_once '../../../../Imports/menu/main_menue.php';
        ?>
        <div class="container">
            <?php
            include_once '../../setting_need/page_header.php';
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="../../Main_category.php">Main Category List</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="../../Sub_category.php">Sub Category List</a>
                        </li>
                        <li class="breadcrumb-item" >
                            <a href="../../Product_List.php" id="set_breadcrum">Camera Product List</a>
                        </li>
                        <li class="breadcrumb-item active">Variable Management</li>
                    </ul>
                </div>
            </div>

        </div>       
        <script type="text/javascript">
            function open_demo_form() {
                var body = document.getElementById("variable_list_body");
                var heading = document.getElementById("variable_cat_name");
                $(heading).empty();
                if (!($(body).is(':visible'))) {

                    var h1 = document.createElement("h2");
                    h1.appendChild(document.createTextNode("Camera"));
                    heading.appendChild(h1);
                } else {
                    var strong = document.createElement("strong");
                    strong.appendChild(document.createTextNode("Camera"));
                    heading.appendChild(strong);
                }
                $("#list_of_variable").slideDown(1000);
                $("#variable_list_body").slideToggle(1000);



            }
            function preview_variable() {
                
                var list_of_variable = document.getElementById("list_of_variable");
                $(list_of_variable).slideUp(1000);
                var preview_variable = document.getElementById("preview_variables");
                $(preview_variable).slideDown(1000);
            }
            function list_variable() {

                var list_of_variable = document.getElementById("list_of_variable");
                $(list_of_variable).slideDown(1000);
                var preview_variable = document.getElementById("preview_variables");
                $(preview_variable).slideUp(1000);
            }

        </script>
        <div class="container w3-theme-l4">
            <div class="row w3-border-bottom w3-border-top w3-border-black w3-margin w3-padding-16">
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row"  >
                            <div class="col-lg-9" id="variable_cat_name">
                                <strong> Camera </strong>
                            </div>

                            <div class="col-lg-1 w3-padding col-sm-4 col-md-4 w3-tooltip">
                                <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey " onclick="open_demo_form()"><span class="fa fa-list-ul"></span></button>
                                <span class="w3-tag w3-small w3-text">View</span>
                            </div>
                            <div class="col-lg-1 w3-padding col-sm-4 col-md-4">
                                <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                            </div>
                            <div class="col-lg-1 w3-padding col-sm-4 col-md-4">
                                <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                            </div>
                        </div>
                        <!------->
                        <div class="row w3-margin w3-theme-light w3-round" id="variable_list_body" style="display: none">
                            <div class="container-fluid w3-margin">
                                <div class="row w3-margin">
                                    <div class="col-lg-7">
                                        <input type="text" class="w3-input w3-border w3-border-black" placeholder="search">
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="w3-input w3-theme-dark w3-hover-blue-grey" onclick="list_variable()">
                                            Add More
                                        </button>
                                    </div>
                                    <div class="col-lg-2">
                                        <button class="w3-input w3-theme-dark w3-hover-blue-grey" onclick="preview_variable()">
                                            Preview
                                        </button>
                                    </div>

                                    <div class="col-lg-1">
                                        <button class="w3-input w3-theme-dark w3-hover-blue-grey" onclick="open_demo_form()" type="button">&times;</button>
                                    </div>
                                </div>


                                <div id="list_of_variable" style="display: none;">
                                    <div class="row">
                                        <hr class="w3-border-black w3-border">
                                        <div class="col-lg-6">test value</div>
                                        <div class="col-lg-3">Number format</div>
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-1 w3-padding col-sm-4 col-md-4 w3-tooltip">
                                            <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                                            <span class="w3-tag w3-small w3-text">Update</span>
                                        </div>
                                        <div class="col-lg-1 w3-padding col-sm-4 col-md-4 w3-tooltip">
                                            <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                                            <span class="w3-tag w3-small w3-text">Delete</span>
                                        </div>
                                    </div>
                                    <!------->
                                    <div class="row">
                                        <hr class="w3-border-black w3-border">
                                        <div class="col-lg-6">test value</div>
                                        <div class="col-lg-3">Number format</div>
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-1 w3-padding col-sm-4 col-md-4 w3-tooltip">
                                            <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                                            <span class="w3-tag w3-small w3-text">Update</span>
                                        </div>
                                        <div class="col-lg-1 w3-padding col-sm-4 col-md-4 w3-tooltip">
                                            <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                                            <span class="w3-tag w3-small w3-text">Delete</span>
                                        </div>
                                    </div>
                                    <!--------->
                                    <div class="row">
                                        <hr class="w3-border-black w3-border">
                                        <div class="col-lg-6">test value</div>
                                        <div class="col-lg-3">Number format</div>
                                        <div class="col-lg-1"></div>
                                        <div class="col-lg-1 w3-padding col-sm-4 col-md-4 w3-tooltip">
                                            <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                                            <span class="w3-tag w3-small w3-text">Update</span>
                                        </div>
                                        <div class="col-lg-1 w3-padding col-sm-4 col-md-4 w3-tooltip">
                                            <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                                            <span class="w3-tag w3-small w3-text">Delete</span>
                                        </div>
                                    </div>
                                    <!------->
                                </div>
                                <!------->
                                <div id="preview_variables" style="display: none;">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label>Name of test 123</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <span class="w3-text-red w3-right">  required </span>
                                            <input type="text" class="w3-input w3-border w3-border-black" placeholder="semethig hear">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <label>Name of test 123</label>
                                        </div>
                                        <div class="col-lg-7">
                                            <span class="w3-text-red w3-right">  required </span>
                                            <input type="number" class="w3-input w3-border w3-border-black" placeholder="semethig hear">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        include_once '../../../../Imports/footer/footer_system.php';
        include_once './variable_settings/modal/variable_settings.php';
        ?>
    </body>
</html>
