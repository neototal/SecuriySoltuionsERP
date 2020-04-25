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
    <body class="w3-theme-light">
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
//            function open_demo_form() {
//                var body = document.getElementById("variable_list_body");
//                var heading = document.getElementById("variable_cat_name");
//                $(heading).empty();
//                if (!($(body).is(':visible'))) {
//
//                    var h1 = document.createElement("h2");
//                    h1.appendChild(document.createTextNode("Camera"));
//                    heading.appendChild(h1);
//                } else {
//                    var strong = document.createElement("strong");
//                    strong.appendChild(document.createTextNode("Camera"));
//                    heading.appendChild(strong);
//                }
//                $("#list_of_variable").slideDown(1000);
//                $("#variable_list_body").slideToggle(1000);
//
//
//
//            }
//            function preview_variable() {
//
//                var list_of_variable = document.getElementById("list_of_variable");
//                $(list_of_variable).slideUp(1000);
//                var preview_variable = document.getElementById("preview_variables");
//                $(preview_variable).slideDown(1000);
//            }
//            function list_variable() {
//
//                var list_of_variable = document.getElementById("list_of_variable");
//                $(list_of_variable).slideDown(1000);
//                var preview_variable = document.getElementById("preview_variables");
//                $(preview_variable).slideUp(1000);
//            }

            $(document).ready(function () {
                data_load_table("", "test test test");
            });

            function data_load_table(cat_id, cat_name) {
                var modal_body_table = document.getElementById("modal_body_table");
                $(modal_body_table).empty();
                alert('3');
                var main_row = document.createElement("div");
                main_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-black w3-margin w3-padding-16")
                var main_col = document.createElement("div");
                main_col.setAttribute("class", "col-lg-12");

                var container_fluid = document.createElement("div");
                container_fluid.setAttribute("class", "container-fluid");
                alert('2')
                var cat_row = document.createElement("div");
                cat_row.setAttribute("class", "row");
                var cat_col_01 = document.createElement("div");
                cat_col_01.setAttribute("class", "col-lg-9 w3-margin-top w3-margin-bottom");

                var strong = document.createElement("strong");
                strong.appendChild(document.createTextNode(cat_name));
                cat_col_01.appendChild(strong);
                cat_row.appendChild(cat_col_01);
                alert('1');

                var cat_col_02 = document.createElement("div");
                cat_col_02.setAttribute("class", "col-lg-1 w3-margin-top w3-margin-bottom w3-tooltip");
                var btn_view = document.createElement("button");
                btn_view.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey ");
                var span_btn_view = document.createElement("span");
                span_btn_view.setAttribute("class", "fa fa-list-ul");
                btn_view.appendChild(span_btn_view);

                var tool_view = document.createElement("span");
                tool_view.setAttribute("class", "w3-tag w3-small w3-text w3-theme-dark");
                tool_view.appendChild(document.createTextNode("view"));
                tool_view.style.width = "100%";

                cat_col_02.appendChild(btn_view);
                cat_col_02.appendChild(tool_view);


                cat_row.appendChild(cat_col_02);

                var cat_col_03 = document.createElement("div");
                cat_col_03.setAttribute("class", "col-lg-1 w3-margin-top w3-margin-bottom w3-tooltip");
                var btn_update = document.createElement("button");
                btn_update.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey");
                var span_btn_update = document.createElement("span");
                span_btn_update.setAttribute("class", "fa fa-pencil-square-o");
                btn_update.appendChild(span_btn_update);

                var tool_update = document.createElement("span");
                tool_update.setAttribute("class", "w3-tag w3-small w3-text w3-theme-dark");
                tool_update.appendChild(document.createTextNode("update"));

                cat_col_03.appendChild(btn_update);
                cat_col_03.appendChild(tool_update);

                cat_row.appendChild(cat_col_03);


                var cat_col_04 = document.createElement("div");
                cat_col_04.setAttribute("class", "col-lg-1 w3-margin-top w3-margin-bottom w3-tooltip");
                var btn_del = document.createElement("button");
                btn_del.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey ");
                var span_btn_del = document.createElement("span");
                span_btn_del.setAttribute("class", "fa fa-trash-o");
                btn_del.appendChild(span_btn_del);

                var tool_del = document.createElement("span");
                tool_del.setAttribute("class", "w3-tag w3-small w3-text w3-red");
                tool_del.appendChild(document.createTextNode("delete"));
                tool_del.style.width = "100%";

                cat_col_04.appendChild(btn_del);
                cat_col_04.appendChild(tool_del);

                cat_row.appendChild(cat_col_04);



                container_fluid.appendChild(cat_row);
                main_col.appendChild(container_fluid);
                main_row.appendChild(main_col);
                
                
                var 

                modal_body_table.appendChild(main_row);
            }
        </script>
        <div class="container w3-theme-l4" id="modal_body_table">
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



                                <div id="list_of_variable" style="display: none;">
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
                                    <div class="row w3-margin">
                                        <div class="col-lg-7">
                                            <!--<input type="text" class="w3-input w3-border w3-border-black" placeholder="search">-->
                                        </div>
                                        <div class="col-lg-2">

                                        </div>
                                        <div class="col-lg-2">
                                            <button class="w3-input w3-theme-dark w3-hover-blue-grey" onclick="list_variable()">
                                                Settings
                                            </button>
                                        </div>

                                        <div class="col-lg-1">
                                            <button class="w3-input w3-theme-dark w3-hover-blue-grey" onclick="open_demo_form()" type="button">&times;</button>
                                        </div>
                                    </div>
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
