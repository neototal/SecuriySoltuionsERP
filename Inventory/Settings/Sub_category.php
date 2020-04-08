<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
include_once '../../Imports/header/session_setup.php';
//$_SESSION['pth'] = "../../";
$_SESSION['title'] = "Sub Category List";
$_SESSION['page_id'] = "000002";
?>
<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include_once '../../Imports/header/basic_header.php';
        include_once '../../Imports/admin_roll_settings/roll_manager.php';
        ?>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#myModal_loder").modal('show');
                set_header_info();
                load_data();


            });

            function set_header_info() {
                var setup_button_list = new Array();
                setup_button_list.push("New Sub Category");
                setup_button_list.push("Branding Settings");
                var button_list = setup_button(setup_button_list);

                button_list[0].addEventListener("click", function () {
//                    alert('test');
                    add_new_data();
                });
                button_list[1].addEventListener("click", function () {
//                    alert('test2');
                    setup_of_brand();
                });
                search();
            }
            function search() {
                var get_search = document.getElementById("search_value");
                get_search.addEventListener("keydown", function () {
                    load_sub_category();
                });
            }

            function load_data() {
                $("#body_table").empty();
                $.ajax({
                    url: "sub_category/load_main_catergory_data.php",
                    type: 'POST',
                    cache: false,
                    success: function (data) {
//                        alert(data);
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {


                            load_main_body_data(json[i].id, json[i].icon_pic, json[i].name, "Sub Category", json[i].dis, "", json[i].show_in_web);

                            load_sub_category();
                        }
                        if (json.length == 0) {
                            window.location.href = "Main_category.php";
                        }

                    }

                });
            }
            function load_sub_category() {
                $("#myModal_loder").modal('show');
                var sending_value = "val=" + $("#search_value").val() + "&name=" + document.getElementById("sub_cat_name").innerHTML;
                var div_body = document.getElementById("body_table");
                var main_id =<?php echo isset($_SESSION['data_id']) ? $_SESSION['data_id'] : ""; ?>;
                $(div_body).empty();
                $.ajax({
                    url: "sub_category/load_sub_catergory_data.php",
                    type: 'POST',
                    data: sending_value,
                    cache: false,
                    success: function (data) {
                        var json = eval(data);
//                        alert(data);
                        for (var i = 0; i < json.length; i++) {
                            data_load(main_id, json[i].idsub_main_category, json[i].name, json[i].dis, json[i].show_in_web);
                        }

                        if (json.length == 0) {
                            var div_body = document.getElementById("body_table");
                            var div_row = document.createElement("div");
                            div_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding");

                            var div_col_01 = document.createElement("div");
                            div_col_01.setAttribute("class", "col-lg-12 w3-center");

                            var strong = document.createElement("strong");

                            strong.appendChild(document.createTextNode("data not found"));

                            div_col_01.appendChild(strong);

                            div_row.appendChild(div_col_01);
                            div_body.appendChild(div_row);
                        }
                        setup_footer();
                    }
                });
            }


            function setup_of_brand() {
                window.location.href = "sub_category/setup_brand/Brand_management.php";
            }


        </script>
    </head>
    <body class="w3-theme-light">
        <?php
        include_once '../../Imports/menu/main_menue.php';
        ?>

        <div class="container">
            <?php
            include_once './setting_need/page_header.php';
            ?>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb" id="breadcrumb_list">
                        <li class="breadcrumb-item">
                            <a href="Main_category.php">Main Category List</a>
                        </li>
                        <li class="breadcrumb-item active">Sub Category List</li>
                    </ul>
                </div>
            </div>
        </div>
        <!------------------------->
        <script type="text/javascript">
//            $(document).ready(function () {
//                var div_body = document.getElementById("body_table");
//                $(div_body).empty();
//                data_load(1, "test", "test 1 test 2 test 3 test 4", 1);
//                data_load(1, "test", "test 1 test 2 test 3 test 4", 0);
//            });

            var i = 0;
            function data_load(main_cat_id, id, name, dis, show_web) {
                var div_body = document.getElementById("body_table");

                var div_row = document.createElement("div");
                if (i == 0) {
                    i++;
                    div_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding");
                } else {
                    div_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding w3-margin-top");
                }

                var div_col_01 = document.createElement("div");
                div_col_01.setAttribute("class", "col-lg-9");
                div_col_01.setAttribute("id", "sub_dis");

                var strong = document.createElement("strong");
                strong.setAttribute("class", "w3-large");
                var name_text = document.createTextNode(name);
                strong.appendChild(name_text);

                var p = document.createElement("p");
                var dis_text = document.createTextNode(dis);
                p.appendChild(dis_text);

                var span = document.createElement("i");
                if (show_web == 0) {
                    var span_text_deactive = document.createTextNode("Show on main web state deactive");
                    span.setAttribute("class", "w3-text-red");
                    span.appendChild(span_text_deactive);
                } else {
                    var span_text = document.createTextNode("Show on main web state active");
                    span.setAttribute("class", "w3-text-grey");
                    span.appendChild(span_text);

                }

                div_col_01.appendChild(strong);
                div_col_01.appendChild(p);
                div_col_01.appendChild(span);

//                ----------

                var div_col_02 = document.createElement("div");
                div_col_02.setAttribute("class", "col-lg-1 w3-padding w3-tooltip col-sm-4 col-md-4");

                var btn_open = document.createElement("button");
                btn_open.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey listing_record");
                var btn_span_open = document.createElement("span");
                btn_span_open.setAttribute("class", "fa fa-list-ul");
                btn_open.appendChild(btn_span_open);
                btn_open.addEventListener("click", function () {
                    next_page(id);
                });

                var btn_tooltip_text_open = document.createElement("span");
                btn_tooltip_text_open.setAttribute("class", "w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center-align");
                btn_tooltip_text_open.style.width = "100%";

                var btn_tooltip_text_open_text = document.createTextNode("open");
                btn_tooltip_text_open.appendChild(btn_tooltip_text_open_text);

                div_col_02.appendChild(btn_open);
                div_col_02.appendChild(btn_tooltip_text_open);

//                ----------

                var div_col_03 = document.createElement("div");
                div_col_03.setAttribute("class", "col-lg-1 w3-padding w3-tooltip col-sm-4 col-md-4");

                var btn_update = document.createElement("button");
                btn_update.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey update_record");
                var btn_span_update = document.createElement("span");
                btn_span_update.setAttribute("class", "fa fa-pencil-square-o");
                btn_update.appendChild(btn_span_update);
                btn_update.addEventListener("click", function () {
//                    (id, name, dis, show_on_web, state_of_update) {
                    set_up_modal(id, name, dis, show_web, true);
                });

                var btn_tooltip_update = document.createElement("span");
                btn_tooltip_update.setAttribute("class", "w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center-align");
                btn_tooltip_update.style.width = "100%";

                var btn_tooltip_update_text = document.createTextNode("update");
                btn_tooltip_update.appendChild(btn_tooltip_update_text);

                div_col_03.appendChild(btn_update);
                div_col_03.appendChild(btn_tooltip_update);

//                ----------
                var div_col_04 = document.createElement("div");
                div_col_04.setAttribute("class", "col-lg-1 w3-padding w3-tooltip col-sm-4 col-md-4");

                var btn_del = document.createElement("div");
                btn_del.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey delete_record");
                var btn_span_del = document.createElement("span");
                btn_span_del.setAttribute("class", "fa fa-trash-o");
                btn_del.appendChild(btn_span_del);
                btn_del.addEventListener("click", function () {
                    if (confirm("do you want to delete " + name + " ?")) {
                        data_del(id);
                    }
                });

                var btn_tooltip_del = document.createElement("span");
                btn_tooltip_del.setAttribute("class", "w3-text w3-tag w3-small w3-red w3-padding-8 w3-center-align");
                btn_tooltip_del.style.width = "100%";
                var btn_tooltip_del_text = document.createTextNode("delete");
                btn_tooltip_del.appendChild(btn_tooltip_del_text);

                div_col_04.appendChild(btn_del);
                div_col_04.appendChild(btn_tooltip_del);


                div_row.appendChild(div_col_01);
                div_row.appendChild(div_col_02);
                div_row.appendChild(div_col_03);
                div_row.appendChild(div_col_04);


                div_body.appendChild(div_row);

            }

            function data_del(id, main_id, name) {
                var sending_value = "id=" + id + "&name=" + name + "&main_name=" + document.getElementById("sub_main_cat_name").innerHTML;
                $.ajax({
                    url: "sub_category/del_data.php",
                    type: 'POST',
                    data: sending_value,
                    cache: false,
                    success: function (data) {
                        load_data();
                    }
                });
            }
            function next_page(id) {
                var sending_value = "sub_cat_id=" + id;
                $.ajax({
                    url: "sub_category/sub_category_id_management.php",
                    type: 'POST',
                    data: sending_value,
                    cache: false,
                    success: function (data) {
                        if (data == "ok") {
                            window.location.href = "Product_List.php";
                        } else {
                            alert('something has went wrong');
                        }

                    }
                });
            }

        </script>
        <div class="container w3-padding-16  w3-round w3-theme-l4 w3-card" id="body_table">
            <div class="row w3-border-bottom w3-border-top w3-border-theme w3-padding">
                <div class="col-lg-9">
                    <strong> Camera </strong>
                    <p>jflaksjfd iofuaoif flkajlkj</p>
                    <span class="w3-text-red">Show on main web state deactive</span>
                </div>

                <div class="col-lg-1 w3-padding w3-tooltip col-sm-4 col-md-4">
                    <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-list-ul"></span></button>
                    <span class="w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center-align" style="width: 100%;">Open</span>
                </div>


                <div class="col-lg-1 w3-padding w3-tooltip col-sm-4 col-md-4">
                    <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                    <span class="w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center-align" style="width: 100%;">Update</span>
                </div>
                <div class="col-lg-1 w3-padding w3-tooltip col-sm-4 col-md-4">
                    <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                    <span class="w3-text w3-tag w3-small w3-red w3-padding-8 w3-center-align" style="width: 100%;">Delete</span>
                </div>
            </div>        
            <!-------------------->
            <div class="row w3-border-bottom w3-border-top w3-border-theme w3-padding w3-margin-top">
                <div class="col-lg-9">
                    <strong> Neo Total Security Solutions </strong>
                    <p> Neo Total Security Solutions Neo Total Security Solutions Neo Total Security Solutions</p>
                    <span class="w3-text-red">Show on main web state deactive</span>
                </div>

                <div class="col-lg-1 w3-padding">
                    <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-list-ul"></span></button>
                </div>
                <div class="col-lg-1 w3-padding">
                    <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                </div>
                <div class="col-lg-1 w3-padding">
                    <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                </div>
            </div>        
        </div>

        <?php
        include_once '../../Imports/footer/footer_system.php';
        include_once './sub_category/modal/sub_category.php';
        ?>
    </body>
</html>
