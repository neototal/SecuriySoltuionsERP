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
                data_load();
            });
            function data_load() {
                var modal_body_table = document.getElementById("modal_body_table");
                $(modal_body_table).empty();
                i = 0;
                $.ajax({
                    url: "variable_settings/load_variable_cat.php",
                    type: 'POST',
                    cache: false,
                    success: function (data) {
                        ;
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            data_load_table(json[i].idproduct_variable_category, json[i].name);
                        }
                        if (json.length == 0) {
                            $("#myModal_loder").modal('hide');
                        }
                    }
                });
            }
            var i = 0;
            function data_load_table(cat_id, cat_name) {
                var modal_body_table = document.getElementById("modal_body_table");


                var main_row = document.createElement("div");


                if (i == 0) {
                    i++;
                    main_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding");
                } else {
                    main_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding w3-margin-top");
                }

                var main_col = document.createElement("div");
                main_col.setAttribute("class", "col-lg-12");

                var container_fluid = document.createElement("div");
                container_fluid.setAttribute("class", "container-fluid");

                var cat_row = document.createElement("div");
                cat_row.setAttribute("class", "row");
                var cat_col_01 = document.createElement("div");
                cat_col_01.setAttribute("class", "col-lg-9 w3-margin-top w3-margin-bottom");

                var strong = document.createElement("strong");
                strong.appendChild(document.createTextNode(cat_name));
                cat_col_01.appendChild(strong);
                cat_row.appendChild(cat_col_01);


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
                btn_update.addEventListener("click", function () {
                    update_variable_cat(cat_id, cat_name);
                });

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
                btn_del.addEventListener("click", function () {
                    if (confirm("do you want to delete " + cat_name)) {
                        remove_variable_cat(cat_id, main_row);
                    }
                });

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

                modal_body_table.appendChild(main_row);


                var preview_div = document.createElement("div");
                preview_div.setAttribute("class", "row w3-margin w3-theme-light w3-round");

                preview_div.style.display = "none";

                modal_body_table.appendChild(preview_div);

                var settings_div = document.createElement("div");
                settings_div.setAttribute("class", "row w3-margin w3-theme-light w3-round");

                settings_div.style.display = "none";


                modal_body_table.appendChild(settings_div);





                btn_view.addEventListener("click", function () {

                    preview_operation(cat_id, cat_name, preview_div, settings_div, cat_col_01, cat_col_02, cat_col_03, cat_col_04);
                    main_row.scrollIntoView(true);
                });


            }
            function close_body(cat_id, cat_name, preview_div_obj, settings_div_obj, heading_div, btn_view_div, btn_update_div, btn_del_div) {
                $(preview_div_obj).empty();
                $(settings_div_obj).empty();

                $(heading_div).empty();

                $(preview_div_obj).slideUp(2000);
                $(settings_div_obj).slideUp(2000);

                var strong = document.createElement("strong");
                strong.appendChild(document.createTextNode(cat_name));
                heading_div.appendChild(strong);

                btn_view_div.style.display = "block";
                btn_update_div.style.display = "block";
                btn_del_div.style.display = "block";

//                preview_div_obj.style.display = "none";
//                settings_div_obj.style.display = "none";

            }
            function preview_operation(cat_id, cat_name, preview_div_obj, settings_div_obj, heading_div, btn_view_div, btn_update_div, btn_del_div) {
                $(preview_div_obj).empty();
                $(settings_div_obj).empty();





                $(heading_div).empty();


                var preview_div_col = document.createElement("div");
                preview_div_col.setAttribute("class", "col-lg-12");
                preview_div_obj.appendChild(preview_div_col);

                var page_header = document.createElement("div");
                page_header.setAttribute("class", "pager-header");
                var h1_obj = document.createElement("h1");
                h1_obj.appendChild(document.createTextNode(cat_name));
                var h1_span = document.createElement("span");
                h1_span.appendChild(document.createTextNode("preview form"))

                page_header.appendChild(h1_obj);
                page_header.appendChild(h1_span);
                heading_div.appendChild(page_header);

                btn_view_div.style.display = "none";
                btn_update_div.style.display = "none";
                btn_del_div.style.display = "none";



                var div_contaner = document.createElement("div");
                div_contaner.setAttribute("class", "container-fluid w3-margin");

                var a_row = document.createElement("div");
                a_row.setAttribute("class", "row");

                var a_col_01 = document.createElement("div");
                a_col_01.setAttribute("class", "col-lg-10");

                var a_col_02 = document.createElement("div");
                a_col_02.setAttribute("class", "col-lg-1 w3-tooltip");

                var btn_settings = document.createElement("button");
                btn_settings.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey");
                var btn_setting_span = document.createElement("span");
                btn_setting_span.setAttribute("class", "fa fa-cog");
                btn_settings.appendChild(btn_setting_span);
                btn_settings.addEventListener("click", function () {
                    setting_operation(cat_id, cat_name, preview_div_obj, settings_div_obj, heading_div, btn_view_div, btn_update_div, btn_del_div);
                });

                var tool_view = document.createElement("span");
                tool_view.setAttribute("class", "w3-tag w3-small w3-text w3-theme-dark");
                tool_view.appendChild(document.createTextNode("setting"));
                tool_view.style.width = "100%";


                a_col_02.appendChild(btn_settings);
                a_col_02.appendChild(tool_view);

                var a_col_03 = document.createElement("div");
                a_col_03.setAttribute("class", "col-lg-1 w3-tooltip");

                var btn_close = document.createElement("button");
                btn_close.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey");
                var btn_close_span = document.createElement("span");
                btn_close_span.setAttribute("class", "fa fa-times");
                btn_close.appendChild(btn_close_span);

                btn_close.addEventListener("click", function () {
                    close_body(cat_id, cat_name, preview_div_obj, settings_div_obj, heading_div, btn_view_div, btn_update_div, btn_del_div);
                });

                var tool_btn_close = document.createElement("span");
                tool_btn_close.setAttribute("class", "w3-tag w3-small w3-text w3-red");
                tool_btn_close.style.width = "100%";
                tool_btn_close.appendChild(document.createTextNode("close"));


                a_col_03.appendChild(btn_close);
                a_col_03.appendChild(tool_btn_close);



                a_row.appendChild(a_col_01);
                a_row.appendChild(a_col_02);
                a_row.appendChild(a_col_03);

                div_contaner.appendChild(a_row);

                preview_div_col.appendChild(div_contaner);

                $(preview_div_obj).slideDown(1000);
                $(settings_div_obj).slideUp(1000);


            }
            function setting_operation(cat_id, cat_name, preview_div_obj, settings_div_obj, heading_div, btn_view_div, btn_update_div, btn_del_div) {
                $(preview_div_obj).empty();
                $(settings_div_obj).empty();



                var settings_div_col = document.createElement("div");
                settings_div_col.setAttribute("class", "col-lg-12");
                settings_div_obj.appendChild(settings_div_col);

                var div_contaner = document.createElement("div");
                div_contaner.setAttribute("class", "container-fluid w3-margin");

                var a_row = document.createElement("div");
                a_row.setAttribute("class", "row");

                var a_col_01 = document.createElement("div");
                a_col_01.setAttribute("class", "col-lg-10");

                var input_search = document.createElement("input");
                input_search.setAttribute("class", "w3-input w3-border w3-border-black");
                input_search.setAttribute("placeholder", "search variable of " + cat_name);
                a_col_01.appendChild(input_search);

                var a_col_02 = document.createElement("div");
                a_col_02.setAttribute("class", "col-lg-1 w3-tooltip");

                var btn_settings = document.createElement("button");
                btn_settings.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey");
                var btn_setting_span = document.createElement("span");
                btn_setting_span.setAttribute("class", "fa fa-bars");
                btn_settings.appendChild(btn_setting_span);
                btn_settings.addEventListener("click", function () {
                    preview_operation(cat_id, cat_name, preview_div_obj, settings_div_obj, heading_div, btn_view_div, btn_update_div, btn_del_div);
                });

                var tool_view = document.createElement("span");
                tool_view.setAttribute("class", "w3-tag w3-small w3-text w3-theme-dark");
                tool_view.appendChild(document.createTextNode("view"));
                tool_view.style.width = "100%";



                a_col_02.appendChild(btn_settings);
                a_col_02.appendChild(tool_view);

                var a_col_03 = document.createElement("div");
                a_col_03.setAttribute("class", "col-lg-1 w3-tooltip");

                var btn_close = document.createElement("button");
                btn_close.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey");
                var btn_close_span = document.createElement("span");
                btn_close_span.setAttribute("class", "fa fa-times");
                btn_close.appendChild(btn_close_span);

                btn_close.addEventListener("click", function () {
                    close_body(cat_id, cat_name, preview_div_obj, settings_div_obj, heading_div, btn_view_div, btn_update_div, btn_del_div);
                });

                var tool_btn_close = document.createElement("span");
                tool_btn_close.setAttribute("class", "w3-tag w3-small w3-text w3-red ");
                tool_btn_close.style.width = "100%";
                tool_btn_close.appendChild(document.createTextNode("close"));


                a_col_03.appendChild(btn_close);
                a_col_03.appendChild(tool_btn_close);



                a_row.appendChild(a_col_01);
                a_row.appendChild(a_col_02);
                a_row.appendChild(a_col_03);

                div_contaner.appendChild(a_row);

                settings_div_col.appendChild(div_contaner);


                $(settings_div_obj).slideDown(1000);
                $(preview_div_obj).slideUp(1000);

                div_contaner.appendChild(document.createElement("hr"));

                var div_body = document.createElement("div");
                list_of_variables(cat_id, "", div_body);
                div_contaner.appendChild(div_body);



            }

            function list_of_variables(cat_id, search_value, div_contaner) {
                list_variable = 0;
                $(div_contaner).empty();
                var sending_value = "cat_id=" + cat_id + "&search_val=" + search_value;
//                alert(sending_value);
                $.ajax({
                    url: "variable_settings/load_variable.php",
                    type: 'POST',
                    data: sending_value,
                    cache: false,
                    success: function (data) {
//                        alert(data);
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            list_of_variable_table(cat_id, search_value, div_contaner, json[i].idproduct_variable, json[i].name, json[i].data_type, json[i].data_type_id, div_contaner);
                        }

                        if (json.length == 0) {
                            div_contaner.setAttribute("class", "w3-center");
                            div_contaner.appendChild(document.createTextNode("Not Found"));
                            $("#myModal_loder").modal('hide');
                        }
                    }

                });


            }
            var list_variable = 0;
            function list_of_variable_table(cat_id, search_value, div_contaner, id, name, data_type, data_type_id, div_contaner) {

                var div_row = document.createElement("div");
                if (list_variable == 0) {
                    list_variable++;
                    div_row.setAttribute("class", "row w3-padding w3-theme-l5 w3-border-bottom w3-border-top w3-border-black w3-hover-grey");
                } else {
                    div_row.setAttribute("class", "row w3-padding w3-theme-l5 w3-border-bottom w3-border-black w3-hover-grey");
                }

                var div_col_01 = document.createElement("div");
                div_col_01.setAttribute("class", "col-lg-6");
                div_col_01.appendChild(document.createTextNode(name));

                var div_col_02 = document.createElement("div");
                div_col_02.setAttribute("class", "col-lg-4");
                div_col_02.appendChild(document.createTextNode(data_type));


                var div_col_03 = document.createElement("div");
                div_col_03.setAttribute("class", "col-lg-1 w3-tooltip");


                var btn_view = document.createElement("button");
                btn_view.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey ");
                var span_btn_view = document.createElement("span");
                span_btn_view.setAttribute("class", "fa fa-list-ul");
                btn_view.appendChild(span_btn_view);


                var tool_view = document.createElement("span");
                tool_view.setAttribute("class", "w3-tag w3-small w3-text w3-theme-dark");
                tool_view.appendChild(document.createTextNode("view"));
                tool_view.style.width = "100%";

                if (data_type == "Drop Down List" || data_type == "Multiple Selections") {

                    div_col_03.appendChild(btn_view);
                    div_col_03.appendChild(tool_view);

                    var body_data_list_row = document.createElement("div");
                    body_data_list_row.setAttribute("class", "row");

                    var body_data_list_col_01 = document.createElement("div");
                    body_data_list_col_01.setAttribute("class", "col-lg-2");

                    var body_data_list_col_02 = document.createElement("div");
                    body_data_list_col_02.setAttribute("class", "col-lg-8");

                    var body_data_list_col_03 = document.createElement("div");
                    body_data_list_col_03.setAttribute("class", "col-lg-2");

                    body_data_list_row.appendChild(body_data_list_col_01);
                    body_data_list_row.appendChild(body_data_list_col_02);
                    body_data_list_row.appendChild(body_data_list_col_03);

                    btn_view.addEventListener("click", function () {
                        $(body_data_list_col_02).empty();
                        load_details_of_multiple_value_list(id, name, data_type, data_type_id, body_data_list_col_02);
                    });
                }



                var div_col_04 = document.createElement("div");
                div_col_04.setAttribute("class", "col-lg-1 w3-tooltip");
                var btn_update = document.createElement("button");
                btn_update.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey");
                var span_btn_update = document.createElement("span");
                span_btn_update.setAttribute("class", "fa fa-pencil-square-o");
                btn_update.appendChild(span_btn_update);

                var tool_update = document.createElement("span");
                tool_update.setAttribute("class", "w3-tag w3-small w3-text w3-theme-dark");
                tool_update.appendChild(document.createTextNode("update"));
                tool_update.style.display = "100%";
                div_col_04.appendChild(btn_update);
                div_col_04.appendChild(tool_update);

                var div_col_05 = document.createElement("div");
                div_col_05.setAttribute("class", "col-lg-1 w3-tooltip");

                var btn_del = document.createElement("button");
                btn_del.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey ");
                btn_del.addEventListener("click", function () {
                    if (confirm("do you want to delete")) {
                        remove_variables(id, div_row, cat_id, search_value, div_contaner);
                    }

                });
                var span_btn_del = document.createElement("span");
                span_btn_del.setAttribute("class", "fa fa-trash-o");
                btn_del.appendChild(span_btn_del);

                var tool_del = document.createElement("span");
                tool_del.setAttribute("class", "w3-tag w3-small w3-text w3-red");
                tool_del.appendChild(document.createTextNode("delete"));
                tool_del.style.width = "100%";

                div_col_05.appendChild(btn_del);
                div_col_05.appendChild(tool_del);


                div_row.appendChild(div_col_01);
                div_row.appendChild(div_col_02);
                div_row.appendChild(div_col_03);
//                div_row.appendChild(div_col_04);
                div_row.appendChild(div_col_05);



                div_contaner.appendChild(div_row);

                if (data_type == "Drop Down List" || data_type == "Multiple Selections") {
                    div_contaner.appendChild(body_data_list_row);
                }
//                div_contaner.appendChild(document.createElement("hr"));
            }
            function load_details_of_multiple_value_list(id, name, data_type_name, data_type_id, div_body) {
                var div_contaner = document.createElement("div");


                div_contaner.setAttribute("class", "container-fluid w3-margin w3-theme-l3 w3-round");


                var a_div_row = document.createElement("div");
                a_div_row.setAttribute("class", "row w3-margin-bottom w3-margin-top");

                var a_div_col_01 = document.createElement("div");
                a_div_col_01.setAttribute("class", "col-lg-8");

                var strong = document.createElement("strong");
                strong.setAttribute("class", "w3-margin");
                strong.appendChild(document.createTextNode(data_type_name + " List for " + name));

                a_div_col_01.appendChild(strong);
//                a_div_col_01.appendChild(document.createElement("hr"));
                a_div_row.appendChild(a_div_col_01);



                var b_div_row = document.createElement("div");
                b_div_row.setAttribute("class", "row");

                var b_div_col_01 = document.createElement("div");
                b_div_col_01.setAttribute("class", "col-lg-8");

                var input_search = document.createElement("input");
                input_search.setAttribute("type", "text");
                input_search.setAttribute("class", "w3-input w3-border w3-border-black");
                input_search.setAttribute("placeholder", "search value form " + name);
                b_div_col_01.appendChild(input_search);

                var b_div_col_02 = document.createElement("div");
                b_div_col_02.setAttribute("class", "col-lg-2");

                var b_div_col_03 = document.createElement("div");
                b_div_col_03.setAttribute("class", "col-lg-2 w3-tooltip");


                var btn_close = document.createElement("button");
                btn_close.setAttribute("class", "w3-button w3-red w3-input w3-round w3-hover-blue-grey");
                var btn_close_span = document.createElement("span");
                btn_close_span.setAttribute("class", "fa fa-times");
                btn_close.appendChild(btn_close_span);

                btn_close.addEventListener("click", function () {
                    if (confirm("do you want to close this")) {
                        $(div_body).empty();
                    }
                });

                var tool_btn_close = document.createElement("span");
                tool_btn_close.setAttribute("class", "w3-tag w3-small w3-text w3-red ");
                tool_btn_close.style.width = "100%";
                tool_btn_close.appendChild(document.createTextNode("close"));

                b_div_col_03.appendChild(btn_close);
                b_div_col_03.appendChild(tool_btn_close);


                b_div_row.appendChild(b_div_col_01);
                b_div_row.appendChild(b_div_col_02);
                b_div_row.appendChild(b_div_col_03);
//                div_row.appendChild(div_col_04);

                var c_div_row = document.createElement("div");
                c_div_row.setAttribute("class", "row");
                var c_div_col_01 = document.createElement("div");
                c_div_col_01.setAttribute("class", "col-lg-12");

                var div_table_body = document.createElement("div");
                div_table_body.setAttribute("class", "container-fluid w3-margin");
                load_details_search(id, data_type_id, div_table_body, "");
                input_search.addEventListener("keydown", function () {
                    load_details_search(id, data_type_id, div_table_body, this.value);
                });

                c_div_col_01.appendChild(div_table_body);
                c_div_row.appendChild(c_div_col_01);



                div_contaner.appendChild(a_div_row);
                div_contaner.appendChild(b_div_row);
                div_contaner.appendChild(c_div_row);
                div_body.appendChild(div_contaner);

            }

            function load_details_search(id, data_type_id, div_table_body, value_of_search) {
                $(div_table_body).empty();
                var sending_value = "id_product=" + id + "&value=";
                var url = "";
                if (data_type_id == 5) {
                    url = "variable_settings/load_multiple.php";
                } else if (data_type_id == 6) {
                    url = "variable_settings/load_drop_down.php";
                }
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: sending_value,
                    catch : false,
                    success: function (data) {
//                        alert(data);
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            if (data_type_id == 5) {
                                load_details_of_multiple_value_list_table(json[i].id_value, json[i].value_of_multiple, json[i].img_pth, div_table_body);
                            } else if (data_type_id == 6) {
                                load_details_of_dropdown_value_list_table(json[i].id_value, json[i].value_of_dropdown, div_table_body);
                            }
                        }
                    }
                });
            }

            function load_details_of_multiple_value_list_table(id, name, img_pth, div_container) {
                var div_row = document.createElement("div");
                div_row.setAttribute("class", "row");

                var div_col_01 = document.createElement("div");
                div_col_01.setAttribute("class", "col-lg-2");
                var image = document.createElement("img");
                image.style.width = "80px";
                if (img_pth == "") {
                    image.setAttribute("src", "<?php echo $pth; ?>Imports/img/Settings/not_found.png");
                } else {
                    image.setAttribute("src", "<?php echo $pth; ?>" + img_pth);
                }
                div_col_01.appendChild(image);


                var div_col_02 = document.createElement("div");
                div_col_02.setAttribute("class", "col-lg-8");

                var p_head = document.createElement("p");
                p_head.setAttribute("class", "w3-padding");
                p_head.appendChild(document.createTextNode(name));
                div_col_02.appendChild(p_head);


                var div_col_03 = document.createElement("div");
                div_col_03.setAttribute("class", "col-lg-2 w3-center");

                var btn = document.createElement("button");
                btn.setAttribute("class", "w3-button w3-red w3-round  w3-hover-blue-grey delete_record");
                var span = document.createElement("span");
                span.setAttribute("class", "fa fa-trash-o");
                btn.appendChild(span);
                div_col_03.appendChild(btn);

                btn.addEventListener("click", function () {
                    if (confirm("do you want to delete this record?")) {

                    }
                });


                div_row.appendChild(div_col_01);
                div_row.appendChild(div_col_02);
                div_row.appendChild(div_col_03);
                div_container.appendChild(div_row);
                div_container.appendChild(document.createElement("hr"));
            }
            function load_details_of_dropdown_value_list_table(id, name, div_container) {
                var div_row = document.createElement("div");
                div_row.setAttribute("class", "row");

                var div_col_01 = document.createElement("div");
                div_col_01.setAttribute("class", "col-lg-10");

                var p_head = document.createElement("p");
                p_head.setAttribute("class", "w3-padding");
                p_head.appendChild(document.createTextNode(name));
                div_col_01.appendChild(p_head);


                var div_col_02 = document.createElement("div");
                div_col_02.setAttribute("class", "col-lg-2 w3-center");

                var btn = document.createElement("button");
                btn.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey delete_record");
                var span = document.createElement("span");
                span.setAttribute("class", "fa fa-trash-o");
                btn.appendChild(span);
                div_col_02.appendChild(btn);

                btn.addEventListener("click", function () {

                    confirm("Press a button!");

                });


                div_row.appendChild(div_col_01);
                div_row.appendChild(div_col_02);
                div_container.appendChild(div_row);
                div_container.appendChild(document.createElement("hr"));

            }
            function remove_multiple_data_record(id, div_row) {
            }
            function remove_drop_down_list(id, div_row) {
                div_row.remove();
            }
            function remove_variables(id, div_row, cat_id, search_value, div_contaner) {
                var sendingvalue = "id=" + id;
                $.ajax({
                    url: "variable_settings/del_variable_management/remove_variable.php",
                    type: 'POST',
                    data: sendingvalue,
                    catch : false,
                    success: function (data) {
                        list_of_variables(cat_id, search_value, div_contaner);
                    }
                });
            }
            function remove_variable_cat(id, div_row) {
                var sendingvalue = "id=" + id;
                $.ajax({
                    url: "variable_settings/del_variable_management/remove_cat.php",
                    type: 'POST',
                    data: sendingvalue,
                    catch : false,
                    success: function (data) {
                        data_load();
                    }
                });
            }
            function update_variable_cat(cat_id, cat_name) {
                $("#modal_head").empty();
                document.getElementById("modal_head").appendChild(document.createTextNode(cat_name + " Update Name"));

                var body = document.getElementById("modal_body");
                document.getElementById("modal_body_image_uploder").display = "none";
                $(body).empty();

                var a_div_row = document.createElement("div");
                a_div_row.setAttribute("class", "row w3-margin-top");

                var a_div_col_01 = document.createElement("div");
                a_div_col_01.setAttribute("class", "col-lg-12");

                var lable = document.createTextNode("Variable category name");
                a_div_col_01.appendChild(lable);

                a_div_row.appendChild(a_div_col_01);

                var b_div_row = document.createElement("div");
                b_div_row.setAttribute("class", "row");

                var b_div_col_01 = document.createElement("div");
                b_div_col_01.setAttribute("class", "col-lg-12");


                var input_text = document.createElement("input");
                input_text.setAttribute("class", "w3-border w3-border-black w3-input");
                input_text.setAttribute("type", "text");
                input_text.setAttribute("placeholder", "variable category name hear");
                input_text.setAttribute("value", cat_name);

                b_div_col_01.appendChild(input_text);
                b_div_row.appendChild(b_div_col_01);

                body.appendChild(a_div_row);
                body.appendChild(b_div_row);

                var modal_error = document.getElementById("modal_error");
                $(modal_error).empty();

                var footer = document.getElementById("modal_footer");
                $(footer).empty();

                var button = document.createElement("button");
                button.setAttribute("class", "w3-button w3-theme-dark w3-round w3-hover-blue-grey");
                button.appendChild(document.createTextNode("Update Variable Category"));

                button.addEventListener("click", function () {
                    if (input_text.value != 0) {
                        update_process(cat_id, input_text.value);
                    } else {
                        input_text.setAttribute("class", "w3-border w3-border-red w3-input");
                        modal_error.appendChild(document.createTextNode("cannot be empty field "));
                    }
                });

                input_text.addEventListener("keydown", function () {
                    $(modal_error).empty();
                    input_text.setAttribute("class", "w3-border w3-border-black w3-input");
                });

                footer.appendChild(button);

                $("#myModal").modal('show');
            }
            function update_process(cat_id, cat_update_name) {

            }
        </script>
        <div class="container w3-padding-16  w3-round w3-theme-l4 w3-card" id="modal_body_table">
            <div class="row w3-border-bottom w3-border-top w3-border-black w3-margin w3-padding-16">
                <div class="col-lg-12">
                    <div class="container-fluid">
                        <div class="row"  >
                            <div class="col-lg-9 " id="variable_cat_name">
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

