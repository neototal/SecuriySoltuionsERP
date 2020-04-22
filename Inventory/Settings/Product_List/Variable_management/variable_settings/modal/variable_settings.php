<script type="text/javascript">

    function add_variable() {
        $("#myModal").modal('show');
        product_variable_cat();
    }

    function product_variable_cat() {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
        modal_head.appendChild(document.createTextNode("Select Variable Category"));

        var modal_body = document.getElementById("modal_body");
        $(modal_body).empty();
        var div_contaner = document.createElement("div");
        div_contaner.setAttribute("class", "container-fluid");

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
                if (json.length == 0) {
                    add_new_variable_cat();
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

        var div_continer = document.createElement("div");
        div_continer.setAttribute("class", "container-fluid");

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
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();

        var modal_body = document.getElementById("modal_body");
        $(modal_body).empty();

        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();

        modal_head.appendChild(document.createTextNode("Select data type to " + cat_name));

        $.ajax({
            url: "variable_settings/load_dataTypes.php",
            type: 'POST',
            cache: false,
            success: function (data) {
                var json = eval(data);
                for (var i = 0; i < json.length; i++) {
                    data_type_listing(json[i].idtype_of_variables, json[i].name, json[i].advance_settings, id_of_cat, cat_name, modal_body);
                }
                if (json.length == 0) {
                    error_id_obj.appendChild(document.createTextNode("refresh your page please "));
                }

            }
        });


//        var data_type_list = new Array();
//        data_type_list[0] = "Number Fromat";
//        data_type_list[1] = "Small Text Fromat";
//        data_type_list[2] = "Large Text Fromat";
//        data_type_list[3] = "Yes / No";
//        data_type_list[4] = "Multiple Selections";
//        data_type_list[5] = "Drop Down List";
//        data_type_list[6] = "Upload Files";
//        data_type_list[7] = "Date Types";
////        data_type_list[8] = "Product Icon";

        modal_body.appendChild(document.createElement("hr"));
//        for (var i = 0; i < data_type_list.length; i++) {
//            data_type_listing(i, data_type_list[i], id_of_cat, cat_name, modal_body);
//        }
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

                        } else {
                            $("#myModal").modal('hide');
                        }
                    } else {
                        error_obj.appendChild(document.createTextNode(data));
                    }
                }
            });

//            if (data_type == "Number Fromat" || data_type == "Small Text Fromat" || data_type == "Large Text Fromat" || data_type == "Yes / No" || data_type == "Date Types") {
//            } else if (data_type == "Multiple Selections") {
//            } else if (data_type == "Drop Down List") {
//            } else if (data_type == "Upload Files") {
//            } else if (data_type == "Date Types") {
//            }

        }
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
            <div class="modal-body" id="modal_body">
                <div class="container-fluid"></div>
            </div>
            <div class="modal-footer" id="modal_footer">

            </div>
        </div>
    </div>
</div>