<script type="text/javascript">



    function add_variable() {
        $("#myModal").modal('show');
        product_variable_cat();
    }

    function product_variable_cat() {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
        modal_head.appendChild(document.createTextNode("Select Variable Category"));

        var image_uploader = document.getElementById("modal_body_image_uploder");
        image_uploader.style.display = "none";

        var modal_body = document.getElementById("modal_body");
        $(modal_body).empty();
        modal_body.scrollTop = "0";

        var div_contaner = document.createElement("div");
//        div_contaner.setAttribute("class", "container-fluid");

        var row_01 = document.createElement("div");
        row_01.setAttribute("class", "row");

        var col_01_01 = document.createElement("div");
        col_01_01.setAttribute("class", "col-lg-8");

        var input_text_search = document.createElement("input");
        input_text_search.setAttribute("class", "w3-input w3-border-black w3-border");
        input_text_search.setAttribute("type", "text");
        input_text_search.setAttribute("placeholder", "search ");
        col_01_01.appendChild(input_text_search);

        var col_01_02 = document.createElement("div");
        col_01_02.setAttribute("class", "col-lg-4");

        var btn_add_new = document.createElement("button");
        btn_add_new.setAttribute("class", "btn btn-default w3-theme-dark w3-input w3-hover-blue-grey");
        btn_add_new.appendChild(document.createTextNode("Add New Category"));
        btn_add_new.addEventListener("click", function () {
//            alert('test');
            add_new_variable_cat();
        });
        col_01_02.appendChild(btn_add_new);


        row_01.appendChild(col_01_01);
        row_01.appendChild(col_01_02);


        var table_body = document.createElement("div");
        load_variable_cat_data("", table_body);
        input_text_search.addEventListener("keydown", function () {
            load_variable_cat_data(this.value, table_body);
        });


        div_contaner.appendChild(row_01);
        div_contaner.appendChild(table_body)
        modal_body.appendChild(div_contaner);
        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();

    }
    function load_variable_cat_data(search_value, table_body) {
        $(table_body).empty();
        table_body.appendChild(document.createElement("hr"));

        var search_value = "value=" + search_value;

        $.ajax({
            url: "variable_settings/load_variable_cat.php",
            type: 'POST',
            data: search_value,
            cache: false,
            success: function (data) {
//                alert(data);
                var json = eval(data);
                for (var i = 0; i < json.length; i++) {
//                    alert('test');
                    table_variable_cat(json[i].idproduct_variable_category, json[i].name, table_body);
                }
                if (search_value != "") {
                    if (json.length == 0) {
                        add_new_variable_cat();
                    }
                }
            }
        });



    }
    function table_variable_cat(id, cat_name, table_body) {
        var row = document.createElement("div");
        row.setAttribute("class", "row");

        var col_01 = document.createElement("div");
        col_01.setAttribute("class", "col-lg-10");
        col_01.appendChild(document.createTextNode(cat_name));


        var col_02 = document.createElement("div");
        col_02.setAttribute("class", "col-lg-2");

        var btn_add = document.createElement("button");
        btn_add.setAttribute("class", "btn btn-default w3-theme-dark w3-input w3-hover-blue-grey");
        btn_add.appendChild(document.createTextNode("Add"));
        col_02.appendChild(btn_add);

        btn_add.addEventListener("click", function () {
            select_data_type_of_variable(id, cat_name, table_body);
        });

        row.appendChild(col_01);
        row.appendChild(col_02);
        table_body.appendChild(row);
        table_body.appendChild(document.createElement("hr"));

    }

    function add_new_variable_cat() {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
        modal_head.appendChild(document.createTextNode("Create New Category"));

        var modal_body = document.getElementById("modal_body");
        $(modal_body).empty();
        modal_body.scrollTop = "0";

        var div_continer = document.createElement("div");
//        div_continer.setAttribute("class", "container-fluid");

        var row_01 = document.createElement("div");
        row_01.setAttribute("class", "row");

        var col_01 = document.createElement("div");
        col_01.setAttribute("class", "col-lg-12");

        var lable = document.createElement("lable");
        lable.appendChild(document.createTextNode("Name"));
        col_01.appendChild(lable);
        row_01.appendChild(col_01);


//        -------------------------------------------------------

        var row_02 = document.createElement("div");
        row_02.setAttribute("class", "row");

        var col_02 = document.createElement("div");
        col_02.setAttribute("class", "col-lg-12");

        var input_text = document.createElement("input");
        input_text.setAttribute("class", "w3-input w3-border w3-border-black");
        input_text.setAttribute("type", "text");
        input_text.setAttribute("placeholder", "some name hear");

        col_02.appendChild(input_text);

        row_02.appendChild(col_02);
//        -------------------------------------------------------

        var row_03 = document.createElement("div");
        row_03.setAttribute("class", "row");
        var col_03 = document.createElement("div");
        col_03.setAttribute("class", "col-lg-12 w3-text-red w3-center");

        var error_id = document.createElement("strong");
        col_03.appendChild(error_id);
        row_03.appendChild(col_03);



        div_continer.appendChild(row_01);
        div_continer.appendChild(row_02);
        div_continer.appendChild(row_03);

        modal_body.appendChild(div_continer);

        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();
        var button_add = document.createElement("button");
        button_add.setAttribute("class", "btn btn-default w3-theme-dark w3-hover-blue-grey");
        button_add.appendChild(document.createTextNode("Next"));
        modal_footer.appendChild(button_add, error_id);


        button_add.addEventListener("click", function () {
            add_new_cat(input_text, error_id);
        });
        input_text.addEventListener("keydown", function () {
            error_remove(this, error_id);
        });

    }

    function add_new_cat(name_of_cat_obj, error_id_obj) {
        if (name_of_cat_obj.value == "") {
            name_of_cat_obj.setAttribute("class", "w3-input w3-red w3-border w3-border-black");
            error_id_obj.appendChild(document.createTextNode("name field cant be empty to continue"));
        } else {
            var sending_value = "name=" + name_of_cat_obj.value + "&s_val_name=" + document.getElementById("sub_cat_name").innerHTML;
            $.ajax({
                url: "variable_settings/add_variable_cat.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
                    if (!isNaN(data)) {
                        select_data_type_of_variable(data, name_of_cat_obj.value, error_id_obj);
                    } else {
                        error_id_obj.appendChild(document.createTextNode(data));
                    }
                }
            });
        }
    }

    function error_remove(text_obj, error_id) {
        text_obj.setAttribute("class", "w3-input w3-border w3-border-black");
        $(error_id).empty();
    }

    function select_data_type_of_variable(id_of_cat, cat_name, error_id_obj) {
//        alert(id_of_cat+" "+cat_name+" "+error_id_obj);
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();

        var modal_body = document.getElementById("modal_body");
        $(modal_body).empty();
        modal_body.scrollTop = "0";

        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();

        modal_head.appendChild(document.createTextNode("Select data type to " + cat_name));

        $.ajax({
            url: "variable_settings/load_dataTypes.php",
            type: 'POST',
            cache: false,
            success: function (data) {
//                alert(data);
                var json = eval(data);
                for (var i = 0; i < json.length; i++) {
                    data_type_listing(json[i].idtype_of_variables, json[i].name, json[i].advance_settings, id_of_cat, cat_name, modal_body);
                }
                if (json.length == 0) {
                    error_id_obj.appendChild(document.createTextNode("refresh your page please "));
                }

            }
        });

        modal_body.appendChild(document.createElement("hr"));

    }
    function data_type_listing(id, data_type_name, state_of_advance, cat_id, cat_name, table_body) {
        var row = document.createElement("div");
        row.setAttribute("class", "row");

        var col_01 = document.createElement("div");
        col_01.setAttribute("class", "col-lg-10");
        col_01.appendChild(document.createTextNode(data_type_name));


        var col_02 = document.createElement("div");
        col_02.setAttribute("class", "col-lg-2");

        var btn_add = document.createElement("button");
        btn_add.setAttribute("class", "btn btn-default w3-theme-dark w3-input w3-hover-blue-grey");
        btn_add.appendChild(document.createTextNode("Select"));
        col_02.appendChild(btn_add);

        btn_add.addEventListener("click", function () {
            single_value_format(cat_id, id, cat_name, data_type_name, state_of_advance);
        });

        row.appendChild(col_01);
        row.appendChild(col_02);
        table_body.appendChild(row);
        table_body.appendChild(document.createElement("hr"));

    }
    function single_value_format(type_id, id_of_cat, cat_name, data_type, state_of_advance) {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();

        modal_head.appendChild(document.createTextNode("Create variable to " + cat_name));

        var modal_body = document.getElementById("modal_body");
        $(modal_body).empty();
        modal_body.scrollTop = "0";

        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();

        var div_continer = document.createElement("div");
        div_continer.setAttribute("class", "container-fluid");

        var row_01 = document.createElement("div");
        row_01.setAttribute("class", "row");

        var col_01 = document.createElement("div");
        col_01.setAttribute("class", "col-lg-12");

        var lable = document.createElement("lable");
        lable.appendChild(document.createTextNode("Name of Variable For " + data_type));
        col_01.appendChild(lable);
        row_01.appendChild(col_01);


//        -------------------------------------------------------

        var row_02 = document.createElement("div");
        row_02.setAttribute("class", "row");

        var col_02 = document.createElement("div");
        col_02.setAttribute("class", "col-lg-12");

        var input_text = document.createElement("input");
        input_text.setAttribute("class", "w3-input w3-border w3-border-black");
        input_text.setAttribute("type", "text");
        input_text.setAttribute("placeholder", "some variable name hear");

        col_02.appendChild(input_text);

        row_02.appendChild(col_02);
//        -------------------------------------------------------

        var row_03 = document.createElement("div");
        row_03.setAttribute("class", "row ");
        var col_03 = document.createElement("div");
        col_03.setAttribute("class", "col-lg-12");

        var check_req = document.createElement("input");
        check_req.setAttribute("class", "w3-check w3-margin-right w3-margin-left");
        check_req.setAttribute("type", "checkbox");
        var check_lable = document.createElement("lable");
        check_lable.appendChild(document.createTextNode("Required Field " + cat_name));
        col_03.appendChild(check_req);
        col_03.appendChild(check_lable);
        row_03.appendChild(col_03);



        var row_04 = document.createElement("div");
        row_04.setAttribute("class", "row");
        var col_04 = document.createElement("div");
        col_04.setAttribute("class", "col-lg-12");
        var h2 = document.createElement("h2");
        var strong = document.createElement("strong");
        strong.appendChild(document.createTextNode("Setting Of " + cat_name));
        h2.appendChild(strong);
        col_04.appendChild(h2);
        row_04.appendChild(col_04);


        var row_05 = document.createElement("div");
        row_05.setAttribute("class", "row");
        var col_05 = document.createElement("div");
        col_05.setAttribute("class", "col-lg-12");

        var check_show_on_web = document.createElement("input");
        check_show_on_web.setAttribute("class", "w3-check w3-margin-right w3-margin-left");
        check_show_on_web.setAttribute("type", "checkbox");
        var check_lable_show_on_web = document.createElement("lable");
        check_lable_show_on_web.appendChild(document.createTextNode("Show output on web "));
        col_05.appendChild(check_show_on_web);
        col_05.appendChild(check_lable_show_on_web);
        row_05.appendChild(col_05);

        var row_06 = document.createElement("div");
        row_06.setAttribute("class", "row");
        var col_06 = document.createElement("div");
        col_06.setAttribute("class", "col-lg-12");

        var check_show_on_invoice = document.createElement("input");
        check_show_on_invoice.setAttribute("class", "w3-check w3-margin-right w3-margin-left");
        check_show_on_invoice.setAttribute("type", "checkbox");
        var check_lable_show_on_invoice = document.createElement("lable");
        check_lable_show_on_invoice.appendChild(document.createTextNode("Show output on invoice "));
        col_06.appendChild(check_show_on_invoice);
        col_06.appendChild(check_lable_show_on_invoice);
        row_06.appendChild(col_06);



        var row_07 = document.createElement("div");
        row_07.setAttribute("class", "row");
        var col_07 = document.createElement("div");
        col_07.setAttribute("class", "col-lg-12");

        var check_show_on_estimate = document.createElement("input");
        check_show_on_estimate.setAttribute("class", "w3-check w3-margin-right w3-margin-left");
        check_show_on_estimate.setAttribute("type", "checkbox");
        var check_lable_show_on_estimate = document.createElement("lable");
        check_lable_show_on_estimate.appendChild(document.createTextNode("Show output on puachase order"));
        col_07.appendChild(check_show_on_estimate);
        col_07.appendChild(check_lable_show_on_estimate);
        row_07.appendChild(col_07);


        var row_08 = document.createElement("div");
        row_08.setAttribute("class", "row");
        var col_08 = document.createElement("div");
        col_08.setAttribute("class", "col-lg-12 w3-text-red w3-center");

        var error_id = document.createElement("strong");
        col_08.appendChild(error_id);
        row_08.appendChild(col_08);



        div_continer.appendChild(row_01);
        div_continer.appendChild(row_02);
        div_continer.appendChild(document.createElement("hr"));
        div_continer.appendChild(row_03);
        div_continer.appendChild(document.createElement("hr"));
        div_continer.appendChild(row_04);
        div_continer.appendChild(document.createElement("hr"));
        div_continer.appendChild(row_05);
        div_continer.appendChild(document.createElement("hr"));
        div_continer.appendChild(row_06);
        div_continer.appendChild(document.createElement("hr"));
        div_continer.appendChild(row_07);
        div_continer.appendChild(document.createElement("hr"));
        div_continer.appendChild(row_08);


        modal_body.appendChild(div_continer);

        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();
        var button_add = document.createElement("button");
        button_add.setAttribute("class", "btn btn-default w3-theme-dark w3-hover-blue-grey");
        button_add.appendChild(document.createTextNode("Create Variable"));
        modal_footer.appendChild(button_add, error_id);


        button_add.addEventListener("click", function () {
            add_data(type_id, id_of_cat, cat_name, data_type, input_text, check_req, check_show_on_web, check_show_on_invoice, check_show_on_estimate, error_id, state_of_advance);
        });
        input_text.addEventListener("keydown", function () {
            error_remove(this, error_id);
        });

    }
    function add_data(type_id, cat_id, cat_name, data_type, name_txt_obj, requard_check_obj, check_show_on_web_obj, check_show_on_invoice_obj, check_show_on_estimate_obj, error_obj, state_of_advance) {
        if (name_txt_obj.value == "") {
            name_txt_obj.setAttribute("class", "w3-input w3-red w3-border w3-border-black");
            error_obj.appendChild(document.createTextNode("name field cant be empty to continue"));
        } else {

            var requard_id = 0, show_on_web_id = 0, show_on_invoice = 0, show_on_estimate_id = 0;
            if (requard_check_obj.checked) {
                requard_id = 1;
            }
            if (check_show_on_web_obj.checked) {
                show_on_web_id = 1;
            }
            if (check_show_on_invoice_obj.checked) {
                show_on_invoice = 1;
            }
            if (check_show_on_estimate_obj.checked) {
                show_on_estimate_id = 1;
            }

            var sending_value = "id_cat=" + cat_id + "&cat_name=" + cat_name + "&data_type_id=" + type_id + "&data_type=" + data_type + "&name_of_variable=" + name_txt_obj.value +
                    "&req=" + requard_id + "&web=" + show_on_web_id + "&invoice=" + show_on_invoice + "&estimate=" + show_on_estimate_id + "&state_of_advance=" + state_of_advance;
            $.ajax({
                url: "variable_settings/add_variable.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
                    if (!isNaN(data)) {
                        if (state_of_advance == "1") {
//                            alert('test');
                            advance_setting_from(data, name_txt_obj.value, type_id, data_type, cat_id, cat_name);
                        } else {
                            $("#myModal").modal('hide');
                        }
                    } else {
                        error_obj.appendChild(document.createTextNode(data));
                    }
                }
            });
        }
    }
//    data_type_list[4] = "Multiple Selections";
//        data_type_list[5] = "Drop Down List";
//        data_type_list[6] = "Upload Files";
//        data_type_list[7] = "Date Types";
////        data_type_list[8] = "Product Icon";

    function advance_setting_from(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name) {
//        alert(id_of_product_variable);
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
        modal_head.appendChild(document.createTextNode("Setting of variable " + product_variable_name + " - " + data_type_name));

        var modal_body = document.getElementById("modal_body");
        $(modal_body).empty();
        modal_body.scrollTop = "0";
        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();




        if (data_type_name == "Multiple Selections") {
            advance_setting_data_list(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, 1);
        } else if (data_type_name == "Drop Down List") {
            advance_setting_data_list(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, 2);
        } else if (data_type_name == "Upload Files") {
            Upload_Files(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer);
        } else if (data_type_name == "Date Types") {
            Date_Types(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer);
        } else {
            $("#myModal").modal('hide');
        }
    }

    function advance_setting_data_list(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, type_of_data) {
        $(modal_body).empty();
        $(modal_footer).empty();
        modal_body.scrollTop = "0";
        var contaner = document.createElement("div");
//        contaner.setAttribute("class", "container-fluid");

        var a_row = document.createElement("div");
        a_row.setAttribute("class", "row");

        var a_col_01 = document.createElement("div");
        a_col_01.setAttribute("class", "col-lg-8");
        var a_search_text = document.createElement("input");
        a_search_text.setAttribute("class", "w3-input w3-border w3-border-black");
        a_search_text.setAttribute("placeholder", "search from hear");
        a_col_01.appendChild(a_search_text)

        var a_col_02 = document.createElement("div");
        a_col_02.setAttribute("class", "col-lg-4");

        var a_add_new = document.createElement("button");
        a_add_new.setAttribute("class", "w3-input w3-button w3-theme-dark w3-hover-blue-grey");
        a_add_new.appendChild(document.createTextNode("Add"));
        a_add_new.addEventListener("click", function () {
            advance_settings_add_new(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, type_of_data);
        });
        a_col_02.appendChild(a_add_new);

        a_row.appendChild(a_col_01);
        a_row.appendChild(a_col_02);
        contaner.appendChild(a_row);


        var table_body = document.createElement("div");
        table_body.setAttribute("class", "w3-margin-top");

        if (type_of_data == 1) {
            Multiple_Selections_load_data(a_search_text.value, id_of_product_variable, table_body, modal_footer, type_of_data);
        } else {
            drop_down_load_data(a_search_text.value, id_of_product_variable, table_body, modal_footer, type_of_data);
        }

        contaner.appendChild(table_body);
        modal_body.appendChild(contaner);

    }
    function drop_down_load_data(sending_value, id_of_product_variable, table_body, modal_footer, type_of_data) {
        $(table_body).empty();
        $(modal_footer).empty();
        table_body.setAttribute("class", "container-fluid");
        table_body.appendChild(document.createElement("hr"));

        var sending_value = "id_product=" + id_of_product_variable + "&value=" + sending_value;
//        alert(sending_value);
        $.ajax({
            url: "variable_settings/load_drop_down.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data) {
                alert(data);
                var json = eval(data);
                for (var i = 0; i < json.length; i++) {
                    drop_down_load_data_table(json[i].id_value, json[i].value_of_dropdown, "", table_body, type_of_data);
                }
                if (json.length == 0) {
                    table_body.setAttribute("class", "w3-center w3-padding");
                    table_body.appendChild(document.createTextNode("data not found"));
                } else {
                    $(modal_footer).empty();
                    var btn = document.createElement("button");
                    btn.setAttribute("class", "w3-button w3-theme-dark w3-hover-blue-grey w3-margin-top");
                    btn.style.width = "250px";
                    btn.appendChild(document.createTextNode(" Finish "));
                    modal_footer.appendChild(btn);
                    btn.addEventListener("click", function () {
                        $("#myModal").modal('hide');
                    });
                }

            }
        });
    }

    function Multiple_Selections_load_data(sending_value, id_of_product_variable, table_body, modal_footer, type_of_data) {
        $(table_body).empty();
        $(modal_footer).empty();
        table_body.setAttribute("class", "container-fluid");
        table_body.appendChild(document.createElement("hr"));

        var sending_value = "id_product=" + id_of_product_variable + "&value=" + sending_value;
//        alert(sending_value);
        $.ajax({
            url: "variable_settings/load_multiple.php",
            type: 'POST',
            data: sending_value,
            cache: false,
            success: function (data) {
//                alert(data);
                var json = eval(data);
                for (var i = 0; i < json.length; i++) {
                    Multiple_Selections_load_data_table(json[i].id_value, json[i].value_of_multiple, json[i].img_pth, table_body, type_of_data);
                }
                if (json.length == 0) {
                    table_body.setAttribute("class", "w3-center w3-padding");
                    table_body.appendChild(document.createTextNode("data not found"));
                } else {
                    $(modal_footer).empty();
                    var btn = document.createElement("button");
                    btn.setAttribute("class", "w3-button w3-theme-dark w3-hover-blue-grey w3-margin-top");
                    btn.style.width = "250px";
                    btn.appendChild(document.createTextNode(" Finish "));
                    modal_footer.appendChild(btn);
                    btn.addEventListener("click", function () {
                        $("#myModal").modal('hide');
                    });
                }

            }
        });
    }
    function drop_down_load_data_table(id, name, img_pth, table_body, type_of_data, type_of_data) {
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
            alert('test');
        });


        div_row.appendChild(div_col_01);
        div_row.appendChild(div_col_02);
        table_body.appendChild(div_row);
        table_body.appendChild(document.createElement("hr"));

    }
    function Multiple_Selections_load_data_table(id, name, img_pth, table_body, type_of_data, type_of_data) {
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
        btn.setAttribute("class", "w3-button w3-red w3-round w3-input w3-hover-blue-grey delete_record");
        var span = document.createElement("span");
        span.setAttribute("class", "fa fa-trash-o");
        btn.appendChild(span);
        div_col_03.appendChild(btn);

        btn.addEventListener("click", function () {
            alert('test');
        });


        div_row.appendChild(div_col_01);
        div_row.appendChild(div_col_02);
        div_row.appendChild(div_col_03);
        table_body.appendChild(div_row);
        table_body.appendChild(document.createElement("hr"));

    }

    function advance_settings_add_new(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, type_of_data) {
        $(modal_body).empty();
        $(modal_footer).empty();
        var contaner = document.createElement("div");
        contaner.setAttribute("class", "container-fluid");

        var a_row = document.createElement("div");
        a_row.setAttribute("class", "row");

        var a_col_01 = document.createElement("div");
        a_col_01.setAttribute("class", "col-lg-12");

        var a_lable = document.createElement("lable");
        a_lable.appendChild(document.createTextNode("Variable Name"));
        var a_input = document.createElement("input");
        a_input.setAttribute("class", "w3-input w3-border w3-border-black");
        a_input.setAttribute("placeholder", "add new variable");
        a_col_01.appendChild(a_lable);
        a_col_01.appendChild(a_input);
        a_row.appendChild(a_col_01);

        //        -------------

        var b_row = document.createElement("div");
        b_row.setAttribute("class", "row");
        var b_col_01 = document.createElement("div");
        b_col_01.setAttribute("class", "col-lg-12");

        var image_uploader = document.getElementById("modal_body_image_uploder");

        if (type_of_data == 1) {
            image_uploader.style.display = "block";
        } else {
            image_uploader.style.display = "none";
        }

//        b_row.appendChild(b_col_01);

        //        -------------


        var error_id = document.createElement("div");
        error_id.setAttribute("class", "w3-text-red w3-center");
//        -------------
        var d_row = document.createElement("div");
        d_row.setAttribute("class", "row");
        var d_col_01 = document.createElement("div");
        d_col_01.setAttribute("class", "col-lg-8");

        var d_col_02 = document.createElement("div");
        d_col_02.setAttribute("class", "col-lg-4");

        var d_button = document.createElement("button");
        d_button.setAttribute("class", "w3-input w3-button w3-theme-dark w3-hover-blue-grey w3-margin-top");
        d_button.appendChild(document.createTextNode("Create"));
        d_col_02.appendChild(d_button);
        d_button.addEventListener("click", function () {
            if (type_of_data == 1) {
                Multiple_Selections_create_new_value_save_to_Db(a_input, id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, error_id, type_of_data);
            } else {
                drop_down_create_new_value_save_to_Db(a_input, id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, error_id, type_of_data);
            }
        });

        a_input.addEventListener("keydown", function () {
            error_remove(a_input, error_id);
        });

        d_row.appendChild(d_col_01);
        d_row.appendChild(d_col_02);

        contaner.appendChild(a_row);
//        contaner.appendChild(document.createElement("hr"));
        contaner.appendChild(b_row);
        contaner.appendChild(error_id);
        modal_footer.appendChild(d_row);

        modal_body.appendChild(contaner);
    }


    function Multiple_Selections_create_new_value_save_to_Db(input_text_obj, id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, error_id, type_of_data) {
        if (input_text_obj.value == "") {
            error_id.appendChild(document.createTextNode("name field cant be empty"));
            input_text_obj.setAttribute("class", "w3-red w3-input w3-border w3-border-black");
        } else {
            var sending_value = "id_product=" + id_of_product_variable + "&value=" + input_text_obj.value;

            var modal_body_image_uploder = document.getElementById("modal_body_image_uploder");
            modal_body_image_uploder.style.display = "none";

            $.ajax({
                url: "variable_settings/add_multiple_value_settings.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
                    advance_setting_data_list(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, type_of_data);
                }
            });

        }
    }

    function drop_down_create_new_value_save_to_Db(input_text_obj, id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, error_id, type_of_data) {
        if (input_text_obj.value == "") {
            error_id.appendChild(document.createTextNode("name field cant be empty"));
            input_text_obj.setAttribute("class", "w3-red w3-input w3-border w3-border-black");
        } else {
            var sending_value = "id_product=" + id_of_product_variable + "&value=" + input_text_obj.value;

            var modal_body_image_uploder = document.getElementById("modal_body_image_uploder");
            modal_body_image_uploder.style.display = "none";

            $.ajax({
                url: "variable_settings/add_drop_down_list.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
                    advance_setting_data_list(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer, type_of_data);
                }
            });

        }
    }

    function close_modal() {
//        $.ajax({
//            url:"",
//        });
    }

    function Drop_Down_List(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer) {


    }
    function Upload_Files(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer) {


    }
    function Date_Types(id_of_product_variable, product_variable_name, data_type_id, data_type_name, cat_id, cat_name, modal_body, modal_footer) {


    }


</script>
<!-- Modal -->

<div class="modal fade w3-white w3-opacity w3-right" data-backdrop="static" data-keyboard="false" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content w3-theme-l4">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3 class="modal-title" id="modal_head">

                </h3>
            </div>
            <div class="modal-body">
                <div class="container-fluid" id="modal_body"></div>
                <div id="modal_body_image_uploder" class="container-fluid" style="display: none;">
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
                <div class="modal-footer" id="modal_footer">

                </div>
            </div>
        </div>
    </div>


    <div >
        <div id="imageUploader" >

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function (e) {
        $("#uploadForm").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "variable_settings/upload_img.php",
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


</script>