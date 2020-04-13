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
                    add_modal();
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
                            load_band_data("");
                        }


                    }

                });
            }
            function load_band_data(search_value) {
                var body_table = document.getElementById("body_table");
                $(body_table).empty();

                var sending_value = "val=" + search_value;
                $.ajax({
                    url: "Brand_management/load_data.php",
                    type: 'POST',
                    data: search_value,
                    cache: false,
                    success: function (data) {
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            load_brand_data_table(json[i].idbrand_info, json[i].icon_pth, json[i].brand_name, json[i].since_date, json[i].show_on_web);
                        }
                        setup_footer();

                        if (json.length == 0) {

                            var body = document.getElementById("body_table");
                            var div_row = document.createElement("div");
                            div_row.setAttribute("class", "row");

                            var div_col = document.createElement("div");
                            div_col.setAttribute("class", "col-lg-12 w3-center");

                            var strong = document.createElement("strong");

                            var text = "data not found";
                            var textTextNode = document.createTextNode(text);

                            strong.appendChild(textTextNode);
                            div_col.appendChild(strong);

                            div_row.appendChild(div_col);

                            body.appendChild(div_row);
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
                <script type="text/javascript">
                    function load_brand_data_table(id, image_url, name, date_of_start, showing_web) {

                        var body_table = document.getElementById("body_table");

                        var div_row = document.createElement("div");
                        div_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding");

                        var div_col_01 = document.createElement("div");
                        div_col_01.setAttribute("class", "col-lg-4 w3-center");
                        var img_brand = document.createElement("img");
                        img_brand.setAttribute("class", "w3-img");
                        if (image_url == "") {
                            img_brand.setAttribute("src", "<?php echo$pth; ?>Imports/img/Settings/not_found.png");
                        } else {
                            img_brand.setAttribute("src", "<?php echo$pth; ?>" + image_url);
                        }
                        img_brand.style.width = "150px";
                        div_col_01.appendChild(img_brand);
                        div_row.appendChild(div_col_01);


                        var div_col_02 = document.createElement("div");
                        div_col_02.setAttribute("class", "col-lg-6");

                        var h2 = document.createElement("h2");
                        var strong = document.createElement("strong");
                        strong.appendChild(document.createTextNode(name));
                        h2.appendChild(strong);

                        var p = document.createElement("p");
                        p.setAttribute("class", "w3-text-red");
                        p.appendChild(document.createTextNode("Since " + date_of_start));

                        var i = document.createElement("i");
                        var span = document.createElement("span");
                        var showing_web_state_msg = "Show on main web state deactive";
                        if (showing_web == "1") {
                            showing_web_state_msg = "Show on main web state active";
                            span.setAttribute("class", "w3-text-gray");
                        } else {
                            span.setAttribute("class", "w3-text-red");
                        }

                        span.appendChild(document.createTextNode(showing_web_state_msg));
                        i.appendChild(span);

                        div_col_02.appendChild(h2);
                        div_col_02.appendChild(p);
                        div_col_02.appendChild(i);

                        div_row.appendChild(div_col_02);
                        body_table.appendChild(div_row);

                        var div_col_03 = document.createElement("div");
                        div_col_03.setAttribute("class", "col-lg-1 w3-padding w3-tooltip");

                        var button_update = document.createElement("button");
                        button_update.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey");

                        var span_button_update = document.createElement("span");
                        span_button_update.setAttribute("class", "fa fa-pencil-square-o");
                        button_update.appendChild(span_button_update);

                        var span_button_lable_update = document.createElement("span");
                        span_button_lable_update.setAttribute("class", "w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center");
                        span_button_lable_update.appendChild(document.createTextNode("update"));

                        div_col_03.appendChild(button_update);
                        div_col_03.appendChild(span_button_lable_update);
                        div_row.appendChild(div_col_03)


                        var div_col_04 = document.createElement("div");
                        div_col_04.setAttribute("class", "col-lg-1 w3-padding w3-tooltip");

                        var button_del = document.createElement("button");
                        button_del.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey w3-red");

                        var span_button_del = document.createElement("span");
                        span_button_del.setAttribute("class", "fa fa-trash-o");
                        button_del.appendChild(span_button_del);

                        var span_button_lable_del = document.createElement("span");
                        span_button_lable_del.setAttribute("class", "w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center");
                        span_button_lable_del.appendChild(document.createTextNode("remove"));

                        div_col_04.appendChild(button_del);
                        div_col_04.appendChild(span_button_lable_del);
                        div_row.appendChild(div_col_04)
                    }



                </script>
                <div class="row w3-border-bottom w3-border-top w3-border-theme w3-padding">
                    <div class="col-lg-4">
                        <img src="../../../../Imports/img/Brands/dahu.png" style="width: 300px;">
                    </div>
                    <div class="col-lg-6">
                        <h2><strong> Neo Total Security Solutions </strong></h2>

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
        include_once './Brand_management/modal/barnd_management.php';
        include_once '../../../../Imports/footer/footer_system.php';
        ?>
    </body>
</html>
