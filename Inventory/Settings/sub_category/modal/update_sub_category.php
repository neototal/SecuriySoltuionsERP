<script type="text/javascript">
    function remove_sub_category_update_modal() {
        $("#name_update").val('');
        $("#dis_update").val('');
        $("#error_id_update").empty();
        $("#show_on_web_update").prop("checked", true);

    }

    function sub_category_modal_update(id_main_category, id, name, dis, show_on_web) {
        alert(id);
        remove_sub_category_update_modal();
        $("#myModal_update").modal('show');
        $("#name_update").val(name);
        $("#dis_update").val(dis);
        if (show_on_web == 1) {
            $("#show_on_web_update").prop("checked", true);
        }
        var update_btn = document.getElementById("update_data_btn__sub_cat");
        update_btn.addEventListener("click", function () {
            alert("a"+id);
            process_update(id, name, dis, show_on_web);
        });
    }
    function remove_error_update() {
        var get_name = document.getElementById("name_update");
        get_name.setAttribute("class", "w3-input w3-border w3-border-grey");
        $("#error_id_update").empty();
    }
    function process_update(id, old_name, old_dis, old_show_on_web) {
        alert("b"+id);
        var get_name = document.getElementById("name_update");
        var error_id = document.getElementById("error_id_update");
        if (get_name.value == "") {
            get_name.setAttribute("class", "w3-input w3-border w3-border-grey w3-red");
            error_id.appendChild(document.createTextNode("name field cant be empty"));
        } else {
            var show_on_web_state = 0;
            if (document.getElementById("show_on_web_update").checked) {
                show_on_web_state = 1;
            }
            var sending_value = "id=" + id + "&old_name=" + old_name + "&old_dis=" + old_dis + "&old_show_on_web=" + old_show_on_web +
                    "&name=" + $("#name_update").val() + "&dis=" + $("#dis_update").val() + "&show_on_web=" + show_on_web_state +
                    "&main_cat_name=" + document.getElementById("sub_main_cat_name").innerHTML;
            alert("c"+id);

            $.ajax({
                url: "sub_category/update_data.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
//                    alert(data);
                    if (data == 1) {
//                        alert(data);
                        load_data();
                        $("#myModal_update").modal('hide');
                    } else {
                        error_id.appendChild(document.createTextNode(data));
                    }
                }
            });
        }
    }
</script>
<!-- Modal -->

<div class="modal fade w3-white w3-opacity w3-right" id="myModal_update" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content w3-theme-l4">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal_head">
                    Update Sub Category	
                </h4>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item">Sub Category List</li>
                                <li class="breadcrumb-item active">Update Sub Category</li>
                            </ul>
                        </div>
                    </div>

                    <!------------------->
                    <div class="row">
                        <div class="col-lg-12">
                            Sub Category Name
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" id="name_update" onkeydown="remove_error_update()" class="w3-input w3-border w3-border-grey" placeholder="some name hear">
                        </div>
                    </div>
                    <hr>
                    <!------------------->
                    <div class="row">
                        <div class="col-lg-12">
                            <lable>Description</lable>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <textarea class="w3-input w3-border w3-border-grey" id="dis_update" placeholder="Note :"></textarea>
                        </div>
                    </div>
                    <hr>
                    <!------------------->

                    <div class="row">
                        <div class="col-lg-12">
                            <input type="checkbox" class="w3-check" id="show_on_web_update"> <label>Show this record in front web</label>
                        </div>
                    </div>

                    <!------------------->
                    <div class="row">
                        <strong>
                            <div class="col-lg-12 w3-center w3-text-red" id="error_id_update">
                                test test test
                            </div>
                        </strong>
                    </div>

                    <!------------------->
                </div>
            </div>
            <div class="modal-footer" id="modal_footer">
                <button class="w3-button w3-theme-dark" id="update_data_btn__sub_cat">Update Category</button>
            </div>
        </div>
    </div>
</div>