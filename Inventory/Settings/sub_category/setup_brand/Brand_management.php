<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../../../Imports/session_manager/session_setup.php';
$_SESSION['title'] = "Register Brand List";
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
            <script type="text/javascript">
                $(document).ready(function () {
                    load_data_to_table(1, "test", "Imports/img/Brands/dahu.png", "dis test test teste", "jan 2015", 1);
                });
                function load_data_to_table(id, name, img_pth, dis, since_date, show_on_web) {
                    var div_body = document.getElementById("body_table");

                    var div_row = document.createElement("div");
                    div_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding w3-margin-top");

                    var div_col_01 = document.createElement("div");
                    div_col_01.setAttribute("class", "col-lg-4");

                    var img = document.createElement("img");
                    if (img_pth == "") {
                        img_pth = "Imports/img/Settings/not_found.png";
                    }
                    img.setAttribute("src", "<?php echo $pth; ?>" + img_pth);
                    img.style.width = "100%";
                    img.style.height = "180px";

                    div_col_01.appendChild(img);
                    div_row.appendChild(div_col_01);

                    var div_col_02 = document.createElement("div");
                    div_col_02.setAttribute("class", "col-lg-6");

                    var strong = document.createElement("strong");
                    var strong_txt = document.createTextNode(name);
                    strong.appendChild(strong_txt);
                    div_col_02.appendChild(strong);

                    var p = document.createElement("p");
                    var p_text = document.createTextNode(dis);
                    p.appendChild(p_text);
                    div_col_02.appendChild(p);

                    var P_01 = document.createElement("p");
                    P_01.setAttribute("class", "w3-text-red");
                    var P_01_text = document.createTextNode("Since : " + since_date);
                    P_01.appendChild(P_01_text);
                    div_col_02.appendChild(P_01);


                    var span = document.createElement("span");
                    var show_on_web_text = "Not Found";
                    if (show_on_web == 1) {
                        show_on_web_text = "Show on main web state active";
                    } else {
                        show_on_web_text = "Show on main web state deactive";
                        span.setAttribute("class", "w3-text-red");
                    }
                    var span_text = document.createTextNode(show_on_web_text);
                    span.appendChild(span_text);
                    div_col_02.appendChild(span);


                    var div_col_03 = document.createElement("div");
                    div_col_03.setAttribute("class", "col-lg-1 col-md-6 col-sm-6 w3-padding w3-tooltip");

                    var button_update = document.createElement("button");
                    button_update.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey");
                    var span_upadte_btn = document.createElement("span");
                    span_upadte_btn.setAttribute("class", "fa fa-pencil-square-o");
                    button_update.appendChild(span_upadte_btn);
                    button_update.addEventListener("click",function(){
                        
                    });

                    var span_update = document.createElement("span");
                    span_update.setAttribute("class", "w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center");
                    var span_update_text = document.createTextNode("update");
                    span_update.style.width = "100%";
                    span_update.appendChild(span_update_text);

                    div_col_03.appendChild(button_update);
                    div_col_03.appendChild(span_update);


                    var div_col_04 = document.createElement("div");
                    div_col_04.setAttribute("class", "col-lg-1 col-md-6 col-sm-6 w3-padding w3-tooltip");

                    var button_del = document.createElement("button");
                    button_del.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey");
                    var button_del_span = document.createElement("span");
                    button_del_span.setAttribute("class", "fa fa-trash-o");
                    button_del.appendChild(button_del_span);
                    button_del.addEventListener("click",function(){
                        
                    });

                    var span_del = document.createElement("span");
                    span_del.setAttribute("class","w3-text w3-tag w3-small w3-red w3-padding-8 w3-center");
                    var span_del_text=document.createTextNode("delete");
                    span_del.appendChild(span_del_text);
                    span_del.style.width="100%";
                    
                    div_col_04.appendChild(button_del);
                    div_col_04.appendChild(span_del);





                    div_row.appendChild(div_col_01);
                    div_row.appendChild(div_col_02);
                    div_row.appendChild(div_col_03);
                    div_row.appendChild(div_col_04);

                    div_body.appendChild(div_row);



                }
            </script>
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
                        <span class="w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center">open</span>
                    </div>
                    <div class="col-lg-1 w3-padding w3-tooltip">
                        <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                        <span class="w3-text w3-tag w3-small w3-red w3-padding-8 w3-center">delete</span>
                    </div>

                </div>
            </div>
        </div>

        <?php
        include_once '../../../../Imports/footer/footer_system.php';
        include_once './Brand_management/modal/brand_management_modal.php';
        ?>
    </body>
</html>
