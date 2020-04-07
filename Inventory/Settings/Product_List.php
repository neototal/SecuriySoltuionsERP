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
        <style type="text/css">
            div{
                /*border: 1px black solid;*/
            }
        </style>
    </head>
    <body class="w3-theme-light">
        <?php
        include_once '../../Imports/menu/main_menue.php';
        ?>
        <div class="container">
            <div class="row jumbotron w3-theme-l4">
                <div class="col-lg-3 col-sm-3">
                    <img src="../../Imports/img/main_categories/1586183229_img_id_over_video-surveillance.jpg" id="sub_main_img" style="width: 250px;">
                </div>
                <div class="col-lg-9 col-sm-9">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 w3-border-black w3-border-bottom w3-margin-bottom">
                                <h2 id="sub_main_cat_name">Camera</h2>
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
                                            <button onclick="add_new_data()" class="btn btn-default w3-theme-dark w3-input w3-button w3-margin-top w3-hover-blue-grey add_record">
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
                            <div class="col-lg-12 w3-text-grey">
                                by main category : Surveillance camera system
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="breadcrumb">
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
