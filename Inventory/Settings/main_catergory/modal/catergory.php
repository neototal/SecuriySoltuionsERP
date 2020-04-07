<script type="text/javascript">
    $(document).ready(function (e) {
        $("#uploadForm").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "main_catergory/upload_image.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
//                    alert(data)
//                    $("#targetLayer").html(data);
                    var img_body = document.getElementById("targetLayer");
                    $(img_body).empty();
                    var img = document.createElement("img");
                    img.setAttribute("class", "image-preview upload-preview");
                    img.setAttribute("src", "<?php echo $pth; ?>" + data);
                    img_body.appendChild(img);
                    after_upload(data);

                },
                error: function ()
                {
                }
            });
        }));
    });

    function add_new() {
        set_up_modal("", "", "", "", "", false);
    }

    function remove_error(name, error_id) {
        name.setAttribute("class", "w3-input w3-border-black w3-border");
        $(error_id).empty();
    }

    function set_up_modal(id, name, dis, img_pth, show_on_web, state_of_update) {
        var heading = document.getElementById("modal_head");
        var breadcrumb_data = document.getElementById("breadcrumb-data");
        $(breadcrumb_data).empty();
        $(heading).empty();
        var heading_text = "Add New Main Category";
        if (state_of_update) {
            heading_text = "Update " + name + " Category";
        }
        breadcrumb_data.appendChild(document.createTextNode(heading_text));
        heading.appendChild(document.createTextNode(heading_text));

        var error_id = document.getElementById("error_id");
        $(error_id).empty();

        document.getElementById("uploadForm").reset();
        var add_btn = document.getElementById("add_btn");


        var change_btn = document.getElementById("change_btn");
        $(change_btn).empty();

        var remove_btn = document.getElementById("remove_btn");
        $(remove_btn).empty();

        var img_location = document.getElementById("targetLayer");
        $(img_location).empty();
        img_location.style.display = "block";

        if (!state_of_update || img_pth == "") {
            add_btn.style.display = "block";
            img_location.appendChild(document.createTextNode("No Image"));
        } else {
            after_upload(img_pth);
            var img = document.createElement("img");
            img.setAttribute("src", "<?php echo $pth; ?>" + img_pth);
            img.setAttribute("class", "image-preview upload-preview");

            img_location.appendChild(img);
        }
//        ----------------------
        var get_body = document.getElementById("modal_body_from");
        $(get_body).empty();
//        ----------------------
        var div_row_01 = document.createElement("div");
        div_row_01.setAttribute("class", "row");

        var div_col_01 = document.createElement("div");
        div_col_01.setAttribute("class", "col-lg-12");

        var lable_name = document.createElement("lable");
        lable_name.appendChild(document.createTextNode(" Category Name"));

        div_col_01.appendChild(lable_name);
        div_row_01.appendChild(div_col_01);

        get_body.appendChild(div_row_01);

//        ----------------------        

        var div_row_02 = document.createElement("div");
        div_row_02.setAttribute("class", "row");

        var div_col_02 = document.createElement("div");
        div_col_02.setAttribute("class", "col-lg-12");

        var input_name = document.createElement("input");
        input_name.setAttribute("class", "w3-input");
        input_name.setAttribute("type", "text");
        input_name.setAttribute("placeholder", "some main category name hear");
        input_name.value = name;
        input_name.addEventListener("keydown", function () {
            remove_error(input_name, error_id);
        });


        div_col_02.appendChild(input_name);
        div_row_02.appendChild(div_col_02);
        get_body.appendChild(div_row_02);

//        ----------------------        
        get_body.appendChild(document.createElement("hr"));
//        ----------------------        

        var div_row_03 = document.createElement("div");
        div_row_03.setAttribute("class", "row");

        var div_col_03 = document.createElement("div");
        div_col_03.setAttribute("class", "col-lg-12");

        var lable_dis = document.createElement("lable");
        lable_dis.appendChild(document.createTextNode(" Category Description "));

        div_col_03.appendChild(lable_dis);
        div_row_03.appendChild(div_col_03);

        get_body.appendChild(div_row_03);

//        ----------------------    
        var div_row_04 = document.createElement("div");
        div_row_04.setAttribute("class", "row");

        var div_col_04 = document.createElement("div");
        div_col_04.setAttribute("class", "col-lg-12");

        var text_area = document.createElement("textarea");
        text_area.setAttribute("class", "w3-input");
        text_area.setAttribute("placeholder", "Note :");

        text_area.style.height = "100px";

        if (state_of_update) {
            text_area.appendChild(document.createTextNode(dis));
        }

        div_col_04.appendChild(text_area);
        div_row_04.appendChild(div_col_04);

        get_body.appendChild(div_row_04);


        //        ----------------------    
        get_body.appendChild(document.createElement("hr"));
        //        ----------------------        

        var div_row_05 = document.createElement("div");
        div_row_05.setAttribute("class", "row");

        var div_col_05 = document.createElement("div");
        div_col_05.setAttribute("class", "col-lg-12");

        var check_box = document.createElement("input");
        check_box.setAttribute("type", "checkbox");
        check_box.setAttribute("class", "w3-check");

        if (show_on_web == 1) {
            $(check_box).prop("checked", true);
        }

        var lable_check_text = document.createElement("label");
        lable_check_text.appendChild(document.createTextNode("  Show this record in front web"));

        div_col_05.appendChild(check_box);
        div_col_05.appendChild(lable_check_text);
        div_row_05.appendChild(div_col_05);

        get_body.appendChild(div_row_05);

        //        ----------------------   
        get_body.appendChild(document.createElement("hr"));
//---------------------------------------------------------------------------------------------------------------------------------
        var footer_body = document.getElementById("modal_footer");
        $(footer_body).empty();

        var button_update = document.createElement("button");
        button_update.setAttribute("class", "w3-button w3-theme-dark w3-round");
        var button_text_update = document.createTextNode("Update " + name + " Category");
        button_update.appendChild(button_text_update);

        button_update.addEventListener("click", function () {

//            (id, old_name, old_dis, old_img_url,old_web_show_state ,name, dis, show_on_web_check, error_id) {
            data_update(id, name, dis, img_pth, show_on_web, input_name, text_area, check_box, error_id);
        });


        var button_add = document.createElement("button");
        button_add.setAttribute("class", "w3-button w3-theme-dark w3-round");
        var button_text_add = document.createTextNode("Add New Category");
        button_add.appendChild(button_text_add);

        button_add.addEventListener("click", function () {
            data_save(input_name, text_area, check_box, error_id);
        });

        if (state_of_update) {

            footer_body.appendChild(button_update);
        } else {
            footer_body.appendChild(button_add);
        }
//---------------------------------------------------------------------------------------------------------------------------------
        $("#myModal").modal('show');
    }
    function after_upload(img_url) {
//        alert(img_url);
        var change_btn = document.getElementById("change_btn");
        $(change_btn).empty();

        var remove_btn = document.getElementById("remove_btn");
        $(remove_btn).empty();


        var add_btn = document.getElementById("add_btn");
        add_btn.style.display = "none";

        var img_setup_remove = document.createElement("button");
        img_setup_remove.setAttribute("class", "w3-button w3-theme-dark w3-red w3-margin w3-input");
        img_setup_remove.appendChild(document.createTextNode("Remove Image"));
        img_setup_remove.addEventListener("click", function () {
            remove_url(img_url, false);
        });
        remove_btn.appendChild(img_setup_remove);


        var img_setup_change = document.createElement("button");
        img_setup_change.setAttribute("class", "w3-button w3-theme-dark w3-margin w3-input");
        img_setup_change.appendChild(document.createTextNode("Change Image"));
        img_setup_change.addEventListener("click", function () {
            remove_url(img_url, true);
        });

        change_btn.appendChild(img_setup_change);


    }

    function remove_url(image_url, state_of_change) {
        var sending_value = "img=" + image_url;
//        alert(image_url);
        $.ajax({
            url: "main_catergory/img_remove.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data) {
                var change_btn = document.getElementById("change_btn");
                $(change_btn).empty();

                var remove_btn = document.getElementById("remove_btn");
                $(remove_btn).empty();

                var img_body = document.getElementById("targetLayer");
                $(img_body).empty();

                if (state_of_change) {
                    var add_btn = document.getElementById("add_btn");
                    add_btn.style.display = "block";
                    img_body.appendChild(document.createTextNode("No Image"));
                } else {
                    img_body.style.display = "none";

                }

            }
        });
    }

    function data_save(name, dis, show_on_web_check, error_id) {
        var error_msg_text_node = null;
        if (name.value == "") {
            error_msg_text_node = document.createTextNode("name field can't be empty");
//            var name = document.getElementById("name");
            name.setAttribute("class", "w3-input w3-red");
        } else {
            var value_of_showing_web = 0;
            if (show_on_web_check.checked) {
                value_of_showing_web = 1;
            }
            var sending_value = "name=" + name.value + "&dis=" + dis.value + "&show_on_web=" + value_of_showing_web;
            $.ajax({
                url: "main_catergory/add_data.php",
                type: 'POST',
                cache: false,
                data: sending_value,
                success: function (data) {
//                    alert(data);
                    data_setup();
                    $("#myModal").modal('hide');
                    if (data == "") {
                        error_msg_text_node = document.createTextNode(data);
                    }
                }
            });

        }
        if (error_msg_text_node != null) {
            error_id.appendChild(error_msg_text_node);
        }

    }
    function data_update(id, old_name, old_dis, old_img_url, old_web_show_state, name, dis, show_on_web_check, error_id) {
        var error_msg_text_node = null;
        if (name.value == "") {
            error_msg_text_node = document.createTextNode("name field can't be empty");
//            var name = document.getElementById("name");
            name.setAttribute("class", "w3-input w3-red");
        } else {
            var value_of_showing_web = 0;
            if (show_on_web_check.checked) {
                value_of_showing_web = 1;
            }
            var sending_value = "id=" + id + "&name=" + name.value + "&dis=" + dis.value + "&old_img_url=" + old_img_url +
                    "&old_name=" + old_name + "&old_dis=" + old_dis + "&show_web=" + value_of_showing_web + "&show_web_old=" + old_web_show_state;
//            alert(sending_value);
            $.ajax({
                url: "main_catergory/update_data.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
//                    alert(data);
                    data_setup();
                    $("#myModal").modal('hide');
                    if (data == "") {
                        error_msg_text_node = document.createTextNode(data);
                    }
                }
            });
        }
        if (error_msg_text_node != null) {
            error_id.appendChild(error_msg_text_node);
        }
    }
</script>
 <!--<script src="http://code.jquery.com/jquery-1.9.1.js"></script>-->
<!-- Modal -->

<div class="modal fade w3-white w3-opacity w3-right" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content w3-theme-l4">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal_head"></h4>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Category List</li>
                                <li class="breadcrumb-item active" id="breadcrumb-data">Create New Category</li>
                            </ul>
                        </div>
                    </div>
                    <div id="modal_body_from">

                    </div>
                    <div id="modal_body_image_uploder">
                        <div class="row">
                            <div class="col-lg-4">
                                <!--img-->
                                <div id="targetLayer" class="w3-margin">No Image</div>
                            </div>
                            <div class="col-lg-8">
                                <div class="container-fluid w3-margin">
                                    <div class="row">
                                        <div class="col-lg-12" id="change_btn">
                                            <!--change btn-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12" id="remove_btn">
                                            <!--remove btn-->
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12" id="add_btn">
                                            <!--add btn-->
                                            <form id="uploadForm" action="main_catergory/upload_image.php" method="post">
                                                <div id="uploadFormLayer">
                                                    <input name="userImage" type="file" class="inputFile w3-input w3-theme-l4" required />
                                                    <input type="submit" class="w3-button w3-theme-dark w3-margin-top w3-input" value="Add Image">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <strong>
                            <div class="col-lg-12 w3-text-red w3-center" id="error_id">
                                test test
                            </div>
                        </strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modal_footer">

            </div>
        </div>
    </div>
</div>