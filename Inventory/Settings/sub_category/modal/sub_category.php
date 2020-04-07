<script type="text/javascript">
    function add_new_data() {
        set_up_modal("", "", "", 0, false);
    }
    function set_up_modal(id, name, dis, show_on_web, state_of_update) {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
        var breadcrumb_data = document.getElementById("breadcrumb_data");
        $(breadcrumb_data).empty();

        var head_text = "Add Sub Category to " + document.getElementById("sub_main_cat_name").innerHTML;
        if (state_of_update) {
            head_text = "Update " + name + " Sub Category";
        }

        modal_head.appendChild(document.createTextNode(head_text));
        breadcrumb_data.appendChild(document.createTextNode(head_text));

//        ------------------------error-------------------------------------

        var error_id = document.getElementById("error_id");
        $(error_id).empty();


//        ------------------------body-------------------------------------

        var modal_body_from = document.getElementById("modal_body_from");
        $(modal_body_from).empty();

//        ------------------

        var div_row_01 = document.createElement("div");
        div_row_01.setAttribute("class", "row");

        var div_col_01 = document.createElement("div");
        div_col_01.setAttribute("class", "col-lg-12");

        var name_text = document.createTextNode("Sub Category Name");

        div_col_01.appendChild(name_text);
        div_row_01.appendChild(div_col_01);
        modal_body_from.appendChild(div_row_01);

//        ---------------

        var div_row_02 = document.createElement("div");
        div_row_02.setAttribute("class", "row");

        var div_col_02 = document.createElement("div");
        div_col_02.setAttribute("class", "col-lg-12");

        var input_text = document.createElement("input");
        input_text.setAttribute("class", "w3-input w3-border w3-border-black");
        input_text.setAttribute("placeholder", "some sub category hear");
        input_text.setAttribute("type", "text");
        input_text.value = name;
        input_text.addEventListener("keydown", function () {
            remove_error(input_text, error_id);
        });

        div_col_02.appendChild(input_text);
        div_row_02.appendChild(div_col_02);
        modal_body_from.appendChild(div_row_02);

//        ---------------

        modal_body_from.appendChild(document.createElement("hr"));

//        ---------------

        var div_row_03 = document.createElement("div");
        div_row_03.setAttribute("class", "row");

        var div_col_03 = document.createElement("div");
        div_col_03.setAttribute("class", "col-lg-12");

        var dis_text = document.createTextNode("Description");

        div_col_03.appendChild(dis_text);
        div_row_03.appendChild(div_col_03);
        modal_body_from.appendChild(div_row_03);
//        ---------------


        var div_row_04 = document.createElement("div");
        div_row_04.setAttribute("class", "row");

        var div_col_04 = document.createElement("div");
        div_col_04.setAttribute("class", "col-lg-12");

        var text_area = document.createElement("textarea");
        text_area.setAttribute("class", "w3-input w3-border w3-border-black");
        text_area.setAttribute("placeholder", "Note :");
        text_area.style.height = "100px";

        if (state_of_update) {
            text_area.appendChild(document.createTextNode(dis));
        }

        div_col_04.appendChild(text_area);
        div_row_04.appendChild(div_col_04);
        modal_body_from.appendChild(div_row_04);


//        ---------------

        modal_body_from.appendChild(document.createElement("hr"));

//        ---------------
        var div_row_05 = document.createElement("div");
        div_row_05.setAttribute("class", "row");

        var div_col_05 = document.createElement("div");
        div_col_05.setAttribute("class", "col-lg-12");

        var check_showing_web = document.createElement("input");
        check_showing_web.setAttribute("class", "w3-check");
        check_showing_web.setAttribute("type", "checkbox");

        if (state_of_update) {
            if (show_on_web == 1) {
//                alert('test');
                $(check_showing_web).prop("checked", true);
            }
        }

        div_col_05.appendChild(check_showing_web);

        var lable = document.createElement("lable");
        var lable_txt = document.createTextNode("Show this record in front web");
        lable.appendChild(lable_txt);

        div_col_05.appendChild(lable);

        div_row_05.appendChild(div_col_05);


        modal_body_from.appendChild(div_row_05);



//        -------------------------footer------------------------------------
        var modal_footer = document.getElementById("modal_footer");
        $(modal_footer).empty();

//        -----------add-----------------------

        var btn_add = document.createElement("button");
        btn_add.setAttribute("class", "w3-button w3-theme-dark w3-hover-blue-gray w3-round");
        var btn_add_text = document.createTextNode("Add New Sub Category");
        btn_add.appendChild(btn_add_text);

//        -----------------update--------------

        var btn_update = document.createElement("button");
        btn_update.setAttribute("class", "w3-button w3-theme-dark w3-hover-blue-grey w3-round");
        var btn_update_text = document.createTextNode("Update " + name + " Sub Category");
        btn_update.appendChild(btn_update_text);


//        ------------------------------------

        if (state_of_update) {
            btn_update.addEventListener("click", function () {
//                process_data_update(id, old_name_text, old_dis_text, old_check_value, name, dis, check, error_id) {
                process_data_update(id, name, dis, show_on_web, input_text, text_area, check_showing_web, error_id);
            });
            modal_footer.appendChild(btn_update);
        } else {
            btn_add.addEventListener("click", function () {
                process_add_new_data(input_text, text_area, check_showing_web, error_id);
            });
            modal_footer.appendChild(btn_add);
        }

//        ------------------------------------

        $("#myModal").modal('show');
    }
    function remove_error(name, error_id) {
        name.setAttribute("class", "w3-input w3-border-black w3-border");
        $(error_id).empty();
    }

    function process_add_new_data(name, dis, check, error_id) {
        if (name.value == "") {
            name.setAttribute("class", "w3-red w3-input w3-border w3-border-black");
            error_id.appendChild(document.createTextNode("name field cant be empty "));
        } else {
            var value_of_showing_web = 0;
            if (check.checked) {
                value_of_showing_web = 1;
            }
            var sending_value = "name=" + name.value + "&dis=" + dis.value + "&show_on_web=" + value_of_showing_web + "&main_name=" + document.getElementById("sub_main_cat_name").innerHTML;

            $.ajax({
                url: "sub_category/add_data.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
//                    alert(data);
                    if (data == 1) {
                        $("#myModal").modal('hide');
                        load_data();
                    } else {
                        error_id.appendChild(data);
                    }
                }
            });


        }
    }

    function process_data_update(id, old_name_text, old_dis_text, old_check_value, name, dis, check, error_id) {
        if (name.value == "") {
            name.setAttribute("class", "w3-red w3-input w3-border w3-border-black");
            error_id.appendChild(document.createTextNode("name field cant be empty "));
        } else {
            var value_of_showing_web = 0;
            if (check.checked) {
                value_of_showing_web = 1;
            }
            var sending_value = "id=" + id + "&old_name=" + old_name_text + "&old_dis=" + old_dis_text + "&old_show_on_web=" + old_check_value +
                    "&name=" + name.value + "&dis=" + dis.value + "&show_on_web=" + value_of_showing_web +
                    "&main_cat_name=" + document.getElementById("sub_main_cat_name").innerHTML;
            $.ajax({
                url: "sub_category/update_data.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
                    load_data();
                    $("#myModal").modal('hide');
                }
            });
        }
    }
</script>

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
                                <li class="breadcrumb-item">Sub Category List</li>
                                <li class="breadcrumb-item active" id="breadcrumb_data">Add Sub Category</li>
                            </ul>
                        </div>
                    </div>
                    <!---------------------------------------->
                    <div id="modal_body_from">

                    </div>
                    <div class="row">
                        <strong>
                            <div class="col-lg-12 w3-text-red w3-center" id="error_id">

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