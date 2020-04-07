
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../Imports/header/session_setup.php';
//$_SESSION['pth'] = "../../";
$_SESSION['title'] = "Main Category List";
$_SESSION['page_id'] = "000001";
if (isset($_SESSION['remove_img'])) {
    unset($_SESSION['remove_img']);
}
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
        <script type="text/javascript">
            $(document).ready(function () {
                data_setup();

            });


            function data_setup() {
                var getText = document.getElementById("getsearch");
                var search_values = "value=" + getText.value;

                $.ajax({
                    url: "main_catergory/load_data.php",
                    type: 'POST',
                    data: search_values,
                    cache: false,
                    success: function (data) {
//                        alert(data);
                        $("#body_table").empty();
                        var json = eval(data);
                        for (var i = 0; i < json.length; i++) {
                            data_load(json[i].idmain_category, json[i].name, json[i].dis, json[i].icon_pic, json[i].show_in_web);
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
            var i = 0;
            function data_load(id, name, dis, img_url, show_no_web) {
//                alert(show_no_web);
                var div_body = document.getElementById("body_table");

                var div_row = document.createElement("div");
                if (i == 0) {
                    i++;
                    div_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding");
                } else {
                    div_row.setAttribute("class", "row w3-border-bottom w3-border-top w3-border-theme w3-padding w3-margin-top");
                }


                var div_col_00 = document.createElement("div");
                div_col_00.setAttribute("class", "col-lg-2");

                var img = document.createElement("img");
                img.setAttribute("src", "<?php echo $pth; ?>" + img_url);
                img.setAttribute("class", "image-preview upload-preview w3-center");
                div_col_00.appendChild(img);


                var div_col_01 = document.createElement("div");
                div_col_01.setAttribute("class", "col-lg-7");

                var strong = document.createElement("strong");
                strong.setAttribute("class","w3-large");
                var nameTextNode = document.createTextNode(name);
                strong.appendChild(nameTextNode);

                var p = document.createElement("p");
                p.setAttribute("class", "sub_dis");
                var disTextNode = document.createTextNode(dis);
                p.appendChild(disTextNode);
                div_col_01.appendChild(strong);
                div_col_01.appendChild(p);

                var span = document.createElement("i");
                var show_on_web_state = "Not Found";

                if (show_no_web == 1) {
                    span.setAttribute("class", "w3-text-grey");
                    show_on_web_state = "Show on main web state active";
                } else {
                    span.setAttribute("class", "w3-text-red");
                    show_on_web_state = "Show on main web state deactive";
                }

                span.appendChild(document.createTextNode(show_on_web_state));
                div_col_01.appendChild(span);

                var div_col_02 = document.createElement("div");
                div_col_02.setAttribute("class", "col-lg-1 w3-padding w3-tooltip col-sm-4 col-md-4");

                var button_01 = document.createElement("button");
                button_01.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey listing_record");
                var span_01 = document.createElement("span");
                span_01.setAttribute("class", "fa fa-list-ul");
                button_01.appendChild(span_01);
                button_01.addEventListener("click", function () {
                    next_page(id);
                });
                var span_open = document.createElement("span");
                span_open.setAttribute("class", "w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center");
                span_open.style.width = "100%";
                var open_text = document.createTextNode("open");

                span_open.appendChild(open_text);

                div_col_02.appendChild(button_01);
                div_col_02.appendChild(span_open);

                var div_col_03 = document.createElement("div");
                div_col_03.setAttribute("class", "col-lg-1 w3-tooltip col-sm-4 col-md-4 w3-padding");

                var button_02 = document.createElement("button");
                button_02.setAttribute("class", "w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey update_record");
                var span_02 = document.createElement("span");
                span_02.setAttribute("class", "fa fa-pencil-square-o");
                button_02.appendChild(span_02);
                button_02.addEventListener("click", function () {
//                    alert('tes');
                    set_up_modal(id, name, dis, img_url, show_no_web, true);
//                    update_data_loader_modal(id, name, dis, img_url, show_no_web);
                });

                var span_update = document.createElement("span");
                span_update.setAttribute("class", "w3-text w3-tag w3-small w3-theme-dark w3-padding-8 w3-center");
                span_update.style.width = "100%";
                var update_text = document.createTextNode("update");
                span_update.appendChild(update_text);


                div_col_03.appendChild(button_02);
                div_col_03.appendChild(span_update);

                var div_col_04 = document.createElement("div");
                div_col_04.setAttribute("class", "col-lg-1 col-sm-4 w3-padding col-md-4 w3-tooltip");

                var button_03 = document.createElement("button");
                button_03.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey delete_record");
                var span_03 = document.createElement("span");
                span_03.setAttribute("class", "fa fa-trash-o");
                button_03.appendChild(span_03);
                button_03.addEventListener("click", function () {
                    if (confirm("Do you want to delete record")) {
                        delete_data(id, name);
                    }
                });

                var span_del = document.createElement("span");
                span_del.setAttribute("class", "w3-text w3-tag w3-small w3-red w3-padding-8 w3-center");
                span_del.style.width = "100%";

                var del_text = document.createTextNode("delete");
                span_del.appendChild(del_text);

                div_col_04.appendChild(button_03);
                div_col_04.appendChild(span_del);

                div_row.appendChild(div_col_00);
                div_row.appendChild(div_col_01);
                div_row.appendChild(div_col_02);
                div_row.appendChild(div_col_03);
                div_row.appendChild(div_col_04);

                div_body.appendChild(div_row);

            }

            function delete_data(id, name) {
                var sending_value = "id=" + id + "&name=" + name;
//                alert(sending_value);
                $.ajax({
                    url: "main_catergory/del_data.php",
                    type: 'POST',
                    data: sending_value,
                    cache: false,
                    success: function (data) {
//                        alert(data);
                        data_setup();
                    }

                });
            }

            function next_page(id) {
                var sending_value = "id=" + id;
                $.ajax({
                    url: "main_catergory/main_catergory_id_management.php",
                    type: 'POST',
                    data: sending_value,
                    cache: false,
                    success: function (data) {
                        if (data == "OK") {
                            window.location.href = "sub_category.php";
                        }
                    }
                });
            }

        </script>
        <style type="text/css">
            div{
                /*border: 1px black solid;*/
            }

            .sub_dis {
                text-align: justify;
                text-justify: inter-word;
            }

        </style>
    </head>
    <body class="w3-theme-light">
        <?php
        include_once '../../Imports/menu/main_menue.php';
        ?>
        <div class="container">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-8 col-sm-12">
                        <h1>Main Category</h1>
                    </div>
                    <div class="col-lg-4 col-sm-12 input-group ">
                        <input type="text" class="form-control" autocomplete="off" placeholder="search from hear" id="getsearch" onkeydown="data_setup()">
                        <span class="input-group-btn">
                            <button class="btn btn-default" onclick="data_setup()"><span class="fa fa-search"></span></button>
                        </span>
                    </div>
                </div>


            </div>
            <div class="row w3-margin">
                <div class="col-lg-9 col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">Main Category List</li>
                    </ol>    
                </div>
                <div class="col-lg-3 col-sm-12">

                    <button class="w3-button w3-theme-dark w3-input w3-round add_record" onclick="add_new()"><span class="fa fa-plus"></span>  New Category</button>
                </div>
            </div>
            <div class="container w3-padding-16  w3-round w3-theme-l4 w3-card" id="body_table">
                <!----------------------------------------------------------------------------------------------->

                <div class="row w3-border-bottom w3-border-black w3-margin">
                    <div class="col-lg-9">
                        <strong> Camera </strong>
                        <p>jflaksjfd iofuaoif flkajlkj</p>
                    </div>

                    <div class="col-lg-1 w3-padding col-sm-4 col-md-4">
                        <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-list-ul"></span></button>
                    </div>
                    <div class="col-lg-1 w3-padding col-sm-4 col-md-4">
                        <button class="w3-button w3-theme-dark w3-round w3-input w3-hover-blue-grey"><span class="fa fa-pencil-square-o"></span></button>
                    </div>
                    <div class="col-lg-1 w3-padding col-sm-4 col-md-4">
                        <button class="w3-button w3-red w3-round w3-input w3-hover-blue-grey"><span class="fa fa-trash-o"></span></button>
                    </div>
                </div>
                <!----------------------------------------------------------------------------------------------->


            </div>
        </div>


        <link rel="stylesheet" href="../../Imports/lib/css/upload_process.css">

        <?php
        include_once '../../Imports/footer/footer_system.php';
        include_once './main_catergory/modal/catergory.php';
        ?>



    </body>
</html>

