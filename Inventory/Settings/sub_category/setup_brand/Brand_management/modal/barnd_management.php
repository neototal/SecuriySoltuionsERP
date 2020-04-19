<script type="text/javascript">
    $(document).ready(function (e) {
        $("#uploadForm").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "Brand_management/image_upload.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    process_image(data);
                },
                error: function ()
                {
                }
            });
        }));
    });

</script>
<!-- Modal -->

<div class="modal fade w3-white" id="myModal" data-backdrop="static" data-keyboard="false" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content w3-theme-l4">
            <div class="modal-header">
                <button type="button" class="close" onclick="remove_img(true)" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal_head">

                </h4>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="container-fluid">
                    <!--//        ------------------------------------------------------------------------------------------------------------------>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item" onclick="close_modal()" id="set_breadcrum_modal">Main Category Brand List</li>
                                <li class="breadcrumb-item active" id="set_breadcrum_modal_current"></li>
                            </ul>
                        </div>
                    </div>
                    <!--//        ------------------------------------------------------------------------------------------------------------------>
                    <div id="modal_body_from">
                        <div class="row">
                            <div class="col-lg-12 input-group">
                                <input type="text" class="form-control ">
                                <span class="input-group-btn">
                                    <button class="btn btn-default"><span class="fa fa-search"</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <!--//        ------------------------------------------------------------------------------------------------------------------>
                    <div id="modal_body_image_uploder">
                        <div class="row">
                            <div class="col-lg-4">
                                <!--img-->
                                <div id="targetLayer" class="w3-margin image-preview ">No Image</div>
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
                        <div class="col-lg-12 w3-text-red w3-center" id="error_id"></div>
                    </div>

                </div>
            </div>
            <div class="modal-footer" id="modal_footer">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function add_modal() {
        load_current_other_main_cat_barnd_list();
//        procee_modal("", "", "", "", "",  false);

    }

    function load_current_other_main_cat_barnd_list() {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
//        ----------------------------------------------------------------------------------------------------------------
        var error_id = document.getElementById("error_id");
        $(error_id).empty();

        var heading_text = "Select Brand To  " + document.getElementById("sub_cat_name").innerHTML;

        modal_head.appendChild(document.createTextNode(heading_text));
//        ----------------------------------------------------------------------------------------------------------------
        document.getElementById("set_breadcrum_modal").innerHTML = document.getElementById("set_breadcrum").innerHTML;
//        ----------------------------------------------------------------------------------------------------------------
        var set_breadcrum_modal_current = document.getElementById("set_breadcrum_modal_current");
        $(set_breadcrum_modal_current).empty()
        var set_breadcrum_modal_current_text = "Select Brand ";

        set_breadcrum_modal_current.appendChild(document.createTextNode(set_breadcrum_modal_current_text));
//        ----------------------------------------------------------------------------------------------------------------
        var upload_body = document.getElementById("add_btn");
        upload_body.style.display = "none";
        var image_body = document.getElementById("targetLayer");
        image_body.style.display = "none";

        var modal_body_from = document.getElementById("modal_body_from");
        $(modal_body_from).empty();

        var div_table_body = document.createElement("div");
        div_table_body.setAttribute("class", "w3-margin-top");
//        div_table_body.style.overflowX = "hidden";
//        div_table_body.style.overflowY = "scroll";
//        div_table_body.style.maxHeight = "450px";
        $(div_table_body).empty();

        var div_row_01 = document.createElement("div");
        div_row_01.setAttribute("class", "row w3-margin-bottom");
        var div_col_01_01 = document.createElement("div");
//        div_col_01_01.setAttribute("class", "col-lg-1");

        var div_col_01_02 = document.createElement("div");
        div_col_01_02.setAttribute("class", "col-lg-8");

        var input_search = document.createElement("input");
        input_search.setAttribute("class", "w3-input w3-border-black w3-border");
        input_search.setAttribute("type", "text");
        input_search.setAttribute("placeholder", "search");
        input_search.addEventListener("keydown", function () {
            $(div_table_body).empty();
            load_other_all_barnds(this.value, div_table_body);
        });



        div_col_01_02.appendChild(input_search);





        var div_col_01_03 = document.createElement("div");
        div_col_01_03.setAttribute("class", "col-lg-4");
        
        var button_select = document.createElement("button");
        button_select.setAttribute("class", "btn btn-default w3-theme-dark w3-input w3-hover-blue-grey");
        button_select.appendChild(document.createTextNode(" Add More"));
        button_select.addEventListener("click", function () {
            procee_modal("", "", "", "", "", false);
        });
        div_col_01_03.appendChild(button_select);

//        div_row_01.appendChild(div_col_01_01);
        div_row_01.appendChild(div_col_01_02);
        div_row_01.appendChild(div_col_01_03);


        modal_body_from.appendChild(div_row_01);

        load_other_all_barnds("", div_table_body);
        modal_body_from.appendChild(div_table_body);

        var footer_body = document.getElementById("modal_footer");
        $(footer_body).empty();




        $("#myModal").modal('show');
    }
    var other_brand_count = 0;
    function load_other_all_barnds(get_search_value, div_table_body) {
        var sending_value = "val=" + get_search_value;
        other_brand_count = 0;
//        alert(sending_value)
        $.ajax({
            url: "Brand_management/load_other_brands.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data) {
//                alert(data);
                var json = eval(data);
                other_brand_count = json.length;
                for (var i = 0; i < json.length; i++) {
                    load_current_other_main_cat_barnd_list_data(json[i].idbrand_info, json[i].brand_name, json[i].since_date, json[i].icon_pth, div_table_body);
                }
                if (json.length == 0) {
                    procee_modal("", "", "", "", "", false);
                }
            }
        });
    }
    function load_current_other_main_cat_barnd_list_data(id, name, date_of_start, img_pth, div_table_body) {

        var modal_body_from = document.getElementById("modal_body_from");
//        modal_body_from.appendChild(document.createElement("hr"));

        var div_row_01 = document.createElement("div");
        div_row_01.setAttribute("class", "row");

        var div_col_01_01 = document.createElement("div");
        div_col_01_01.setAttribute("class", "col-lg-2 w3-center");

        var img = document.createElement("img");
        if (img_pth == "") {
            img.setAttribute("src", "<?php echo $pth; ?>Imports/img/Settings/not_found.png");
        } else {
            img.setAttribute("src", "<?php echo $pth; ?>" + img_pth);
        }
        img.style.width = "60px";

        div_col_01_01.appendChild(img);

        //-------------------------------
        var div_col_01_02 = document.createElement("div");
        div_col_01_02.setAttribute("class", "col-lg-7");
        var h2 = document.createElement("h3");
        var strong = document.createElement("strong");
        strong.appendChild(document.createTextNode(name));
        h2.appendChild(strong);

        var p = document.createElement("p");
        p.setAttribute("class", "w3-text-red");
        p.appendChild(document.createTextNode("Since " + date_of_start));
        div_col_01_02.appendChild(h2);
        div_col_01_02.appendChild(p);


        var div_col_01_03 = document.createElement("div");
        div_col_01_03.setAttribute("class", "col-lg-2");

        var button_select = document.createElement("button");
        button_select.setAttribute("class", "btn btn-default w3-theme-dark w3-input w3-margin-top w3-hover-blue-grey select_record");
        button_select.appendChild(document.createTextNode("add"));
        button_select.addEventListener("click", function () {
            basic_save(id, div_row_01);
        });
        div_col_01_03.appendChild(button_select);


        div_row_01.appendChild(div_col_01_01);
        div_row_01.appendChild(div_col_01_02);
        div_row_01.appendChild(div_col_01_03);

        div_table_body.appendChild(div_row_01);


    }
    function basic_save(id, row_div) {
        var sending_value = "id=" + id + "&main_cat=" + document.getElementById("sub_cat_name").innerHTML;
        $.ajax({
            url: "Brand_management/update_brand_state.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data) {
                row_div.remove();
                other_brand_count--;
                if (other_brand_count == 0) {
                    procee_modal("", "", "", "", "", false);
                }
                load_data();
            }
        });
    }

    function procee_modal(id, name, img_pth, since_date, show_on_web_state, update_state) {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
//        ----------------------------------------------------------------------------------------------------------------
        var error_id = document.getElementById("error_id");
        $(error_id).empty();

        document.getElementById("uploadForm").reset();



//        ----------------------------------------------------------------------------------------------------------------
        var heading_text = "Register New Brand To " + document.getElementById("sub_cat_name").innerHTML;
        if (update_state) {
            heading_text = "Update " + name;
        }
        modal_head.appendChild(document.createTextNode(heading_text));
//        ----------------------------------------------------------------------------------------------------------------
        document.getElementById("set_breadcrum_modal").innerHTML = document.getElementById("set_breadcrum").innerHTML;
//        ----------------------------------------------------------------------------------------------------------------
        var set_breadcrum_modal_current = document.getElementById("set_breadcrum_modal_current");
        $(set_breadcrum_modal_current).empty()
        var set_breadcrum_modal_current_text = "Add new record";
        if (update_state) {
            set_breadcrum_modal_current_text = "update " + name;
        }
        set_breadcrum_modal_current.appendChild(document.createTextNode(set_breadcrum_modal_current_text));
//        ----------------------------------------------------------------------------------------------------------------

        var modal_body_from = document.getElementById("modal_body_from");
        $(modal_body_from).empty();

        var div_row_01 = document.createElement("div");
        div_row_01.setAttribute("class", "row");
        var div_col_01 = document.createElement("div");
        div_col_01.setAttribute("class", "col-lg-12");

        var lable_01 = document.createElement("lable");
        lable_01.appendChild(document.createTextNode("Name"));
        div_col_01.appendChild(lable_01);
        var name_text = document.createElement("input");
        name_text.setAttribute("type", "text");
        name_text.setAttribute("class", "w3-input w3-border w3-border-black");
        name_text.setAttribute("placeholder", "some name hear");
        name_text.value = name;
        name_text.addEventListener("keydown", function () {
            remove_error(name_text, error_id);
        });
        div_col_01.appendChild(name_text);

        div_row_01.appendChild(div_col_01);


        var div_row_02 = document.createElement("div");
        div_row_02.setAttribute("class", "row");
        var div_col_02 = document.createElement("div");
        div_col_02.setAttribute("class", "col-lg-12");



        var div_row_03 = document.createElement("div");
        div_row_03.setAttribute("class", "row");
        var div_col_03 = document.createElement("div");
        div_col_03.setAttribute("class", "col-lg-12");

        var lable_03 = document.createElement("lable");
        lable_03.appendChild(document.createTextNode("Date Start"));
        div_col_03.appendChild(lable_03);
        var name_date = document.createElement("input");
        name_date.setAttribute("class", "w3-input w3-border w3-border-black");
        name_date.setAttribute("type", "date");
        name_date.value = since_date;
        div_col_03.appendChild(name_date);

        div_row_03.appendChild(div_col_03);



        var div_row_04 = document.createElement("div");
        div_row_04.setAttribute("class", "row");
        var div_col_04 = document.createElement("div");
        div_col_04.setAttribute("class", "col-lg-12");

        var check = document.createElement("input");
        check.setAttribute("type", "checkbox");
        check.setAttribute("class", "w3-check");
        div_col_04.appendChild(check);
        if (update_state) {
            if (show_on_web_state) {
                $(check).prop("checked", true);
            }
        }

        var lable_04 = document.createElement("lable");
        lable_04.appendChild(document.createTextNode("  Show this record in front web"));
        div_col_04.appendChild(lable_04)



        div_row_04.appendChild(div_col_04);


        modal_body_from.appendChild(div_row_01);
        modal_body_from.appendChild(document.createElement("hr"));
        modal_body_from.appendChild(div_row_02);
        modal_body_from.appendChild(div_row_03);
        modal_body_from.appendChild(document.createElement("hr"));
        modal_body_from.appendChild(div_row_04);
        modal_body_from.appendChild(document.createElement("hr"));




//        ----------------------------------------------------------------
        var footer_body = document.getElementById("modal_footer");
        $(footer_body).empty();

        var button_add = document.createElement("button");
        button_add.setAttribute("class", "w3-button w3-theme-dark w3-hover-blue-grey w3-round");
        button_add.appendChild(document.createTextNode("Add New Record"));
        button_add.addEventListener("click", function () {
            add_data(name_text, name_date, check, error_id);
        });


        var button_update = document.createElement("button");
        button_update.setAttribute("class", "w3-button w3-theme-dark w3-hover-blue-grey w3-round");
        button_update.appendChild(document.createTextNode("Update " + name));
        button_update.addEventListener("click", function () {
            update_data(id, name, since_date, show_on_web_state, img_pth, name_text, name_date, check, error_id);
        });

        if (update_state) {
            footer_body.appendChild(button_update);
        } else {
            footer_body.appendChild(button_add);
        }

        process_image(img_pth);
        $("#myModal").modal('show');
    }

    function process_image(img_pth) {
        var upload_body = document.getElementById("add_btn");

        var remove_btn = document.getElementById("remove_btn");
        $(remove_btn).empty();
        var change_btn = document.getElementById("change_btn");
        $(change_btn).empty();

        var image_body = document.getElementById("targetLayer");
        $(image_body).empty();

//        ---------------------------------------------------------------------

        var btn_chage = document.createElement("button");
        btn_chage.setAttribute("class", "w3-button w3-theme-dark w3-margin w3-input");
        btn_chage.appendChild(document.createTextNode("Change Image"));
        btn_chage.addEventListener("click", function () {
            remove_img(false);

        });


        var btn_remove = document.createElement("button");
        btn_remove.setAttribute("class", "w3-button w3-theme-dark w3-red w3-margin w3-input");
        btn_remove.appendChild(document.createTextNode("Remove Image"));
        btn_remove.addEventListener("click", function () {
            remove_img(true);

        });


//        ---------------------------------------------------------------------

//        alert(img_pth);
        if (img_pth == "") {
            image_body.appendChild(document.createTextNode("No Image"));
            upload_body.style.display = "block";
            image_body.style.display = "block";
        } else {
            upload_body.style.display = "none";
            image_body.style.display = "block";
            var img = document.createElement("img");
            img.setAttribute("src", "<?php echo $pth; ?>" + img_pth);
            img.setAttribute("class", "image-preview");
            image_body.appendChild(img);
            change_btn.appendChild(btn_chage);
            remove_btn.appendChild(btn_remove);

        }
    }

    function add_data(name_obj, data_obj, show_on_web_obj, error_id) {
        if (name_obj.value == "") {
            name_obj.setAttribute("class", "w3-red w3-input w3-border w3-border-black");
            error_id.appendChild(document.createTextNode("name field cant be empty"));
//            alert(data_obj.value);

        } else {
            var state_of_web = 0;
            if (show_on_web_obj.checked) {
                state_of_web = 1;
            }

            var sending_value = "name=" + name_obj.value + "&date_of_reg=" + data_obj.value + "&show_on_web_sate=" + state_of_web + "&main_cat=" + document.getElementById("sub_cat_name").innerHTML;
//            alert(sending_value);
            $.ajax({
                url: "Brand_management/add_data.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
//                    alert(data);
                    if (data == "") {
                        close_modal();
                        load_band_data();
                    } else {
                        name_obj.setAttribute("class", "w3-red w3-input w3-border w3-border-black");
                        error_id.appendChild(document.createTextNode(data));
                    }
                }
            });
        }
    }

    function update_data(id, old_name, old_date, old_show_on_web, old_image_pth, name_obj, data_obj, show_on_web_obj, error_id) {
    }


    function remove_error(input, error) {
        $(error).empty();
        input.setAttribute("class", "w3-input w3-border w3-border-black");
    }
//C:\xampp\htdocs\SecuriySoltuionsERP\Imports\PHP_IO\img_del.php
    function remove_img(state_remove_image) {
        $.post("<?php echo $pth; ?>Imports/PHP_IO/img_del.php", function (data, state) {
            var image_body = document.getElementById("targetLayer");
            var upload_body = document.getElementById("add_btn");

            var remove_btn = document.getElementById("remove_btn");
            $(remove_btn).empty();
            var change_btn = document.getElementById("change_btn");
            $(change_btn).empty();


            if (state_remove_image) {
                image_body.style.display = "none";
                upload_body.style.display = "none";
            } else {
                $(image_body).empty();
                image_body.appendChild(document.createTextNode("Not Found"));
                upload_body.style.display = "block";
                image_body.style.display = "block";
            }
        });

    }

    function close_modal() {
        $("#myModal").modal('hide');
    }

</script>