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
                window.location.href = "Product_List/variable_settings.php";
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
//                    alert('test');

                });
                button_list[1].addEventListener("click", function () {
//                    alert('test2');

                });

            }
            function load_main_body() {
                var send_value = "sub_id=<?php echo isset($_SESSION['sub_cat_id']) ? $_SESSION['sub_cat_id'] : ""; ?>";
//                alert(send_value);
                $.ajax({
                    url: "Product_List/Variable_management/variable_settings/load_sub_head.php",
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

<<<<<<< HEAD
=======
            #sub_dis {
                text-align: justify;
                text-justify: inter-word;
            }

        </style>
        <script type="text/javascript">
            function settings_href() {
                window.location.href = "Product_List/variable_settings.php";
            }
            $(document).ready(function (){
                load_main_body();
            });
            function load_main_body() {
                var send_value = "sub_id=<?php echo isset($_SESSION['sub_cat_id']) ? $_SESSION['sub_cat_id'] : ""; ?>";
                alert(send_value);
                $.ajax({
                    url: "Product_List/variable_settings/load_sub_head.php",
                    type: 'POST',
                    data: send_value,
                    cache: false,
                    success: function (data) {
                        alert(data);
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            load_main_body_data(json[i].id,json[i].img_path,json[i].sub_name,json[i].sub_dis,json[i].main_cat_name,json[i].show_in_web);
                        }
                    }
                });

            }
            function load_main_body_data(id, img_url, sub_cat_name, dis, man_cat_name,show_web_state) {
                var seup_img = document.getElementById("sub_main_img");
                seup_img.setAttribute("src", "<?php echo $pth; ?>" + img_url);

                var set_sub_cat_name = document.getElementById("sub_cat_name");
                $(set_sub_cat_name).empty();
                set_sub_cat_name.appendChild(document.createTextNode(sub_cat_name));

                var set_dis = document.getElementById("sub_dis");
                $(set_dis).empty();
                set_dis.appendChild(document.createTextNode(dis));

                var set_main_cat = document.getElementById("main_cat_name");
                $(set_main_cat).empty();
                set_main_cat.appendChild(document.createTextNode("by main category : " + man_cat_name));

                var set_breadcrum = document.getElementById("set_breadcrum");
                $(set_breadcrum).empty();
                set_breadcrum.appendChild(document.createTextNode(sub_cat_name + " Product List"));
                
                if(show_web_state==1){
                    $("#show_on_web").prop("checked",true);
                }
            }
>>>>>>> master
        </script>
    </head>
    <body class="w3-theme-light">
        <?php
        include_once '../../Imports/menu/main_menue.php';
        ?>
        <div class="container">
<<<<<<< HEAD
            <?php include_once './setting_need/page_header.php'; ?>
=======
            <div class="row jumbotron w3-theme-l4">
                <div class="col-lg-3 col-sm-3">
                    <img src="../../Imports/img/main_categories/1586183229_img_id_over_video-surveillance.jpg" id="sub_main_img" style="width: 250px;">
                </div>
                <div class="col-lg-9 col-sm-9">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 w3-border-black w3-border-bottom w3-margin-bottom">
                                <h2 id="sub_cat_name">Camera Test</h2>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search_value" onclick="load_data()" autocomplete="off" placeholder="search">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default"><span class="fa fa-search"></span></button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-8" id="sub_dis">
                                Bootstrap is the most popular HTML, CSS, and JS framework for developing
                                responsive, mobile-first projects on the web.
                            </div>
                            <div class="col-lg-4">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button onclick="add_new_data()" class="btn btn-default w3-theme-dark w3-input  w3-margin-top w3-hover-blue-grey add_record">
                                                <!--<span class="fa fa-plus"></span>-->
                                                <strong>
                                                    New Product
                                                </strong>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <button onclick="settings_href()" class="btn btn-default w3-theme-dark w3-input w3-button w3-margin-top w3-hover-blue-grey add_record">
                                                    <!--<span class="fa fa-plus"></span>-->
                                                <strong>
                                                    Settings
                                                </strong>
                                            </button>                                       
                                        </div> 
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!------>

                        <div class="row">
                            <div class="col-lg-12">
                                <input class="w3-check" id="show_on_web" type="checkbox">
                                <label>View On Main Web </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 w3-text-grey" id="main_cat_name">
                                by main category : Surveillance camera system
                            </div>
                        </div>
                    </div>
                </div>
            </div>
>>>>>>> master
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
