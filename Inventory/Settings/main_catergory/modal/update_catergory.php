<script type="text/javascript">
    function remove_update() {
        document.getElementById("img_befor_update").style.display = "none";
        document.getElementById("img_after_update").style.display = "none";
        $("#show_on_web_update").prop("checked", false);

        var body_img = document.getElementById("targetLayer_update");
        $(body_img).empty();
//        body_img.appendChild(document.createTextNode("No Image"));
        document.getElementById("uploadForm_update").reset();
        $("#name_update").val();
        $("#dis_update").val();

    }
    function default_text_field_update() {
        var name = document.getElementById("name_update");
        name.setAttribute("class", "w3-input");
        var error = document.getElementById("error_id_update");
        $(error).empty();
    }
    function reset_from_update() {
        remove_update();
        document.getElementById("name_update").value = "";
        document.getElementById("dis_update").value = "";
        document.getElementById("image_state_update").value = "0";
    }

    $(document).ready(function (e) {
        $("#uploadForm_update").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "main_catergory/update_image.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    alert(data);
                    $("#targetLayer_update").html(data);
                    document.getElementById("img_befor_update").style.display = "none";
                    document.getElementById("img_after_update").style.display = "block";
                    document.getElementById("image_state_update").value = "1";
                },
                error: function ()
                {
                }
            });
        }));
    });

    function remove_image() {
        document.getElementById("img_remove_update").style.display = "none";
        document.getElementById("image_state_update").value = "0";
    }
    function change_image() {
        document.getElementById("img_after_update").style.display = "none";
        document.getElementById("img_befor_update").style.display = "block";
        var img_div = document.getElementById("targetLayer_update");
        $(img_div).empty();
        img_div.appendChild(document.createTextNode("No Image"));
        document.getElementById("image_state_update").value = "0";
    }
    function update_data(id, name, dis, show_on_web) {
        var error = document.getElementById("error_id_update");
        var error_msg_text_node = null;
        if ($("#name_update").val() == "") {
            error_msg_text_node = document.createTextNode("name field can't be empty");
            var name = document.getElementById("name_update");
            name.setAttribute("class", "w3-input w3-red");
        } else {
            var value_of_showing_web = 0;
            if (document.getElementById("show_on_web_update").checked) {
                value_of_showing_web = 1;
            }
//            alert(value_of_showing_web);
            var sending_value = "id=" + id + "&name=" + $("#name_update").val() + "&dis=" + $("#dis_update").val() + "&img_state=" + $("#image_state_update").val() +
                    "&old_name=" + name + "&old_dis=" + dis + "&show_web=" + value_of_showing_web + "&show_web_old=" + show_on_web;
//            alert(sending_value);
            $.ajax({
                url: "main_catergory/update_data.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
                    $("#myModal_update").modal('hide');
                    data_setup();
//                    alert(data);

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
                <h4 class="modal-title" id="modal_head">Update Category</h4>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="container-fluid ">
                    <div class="row">
                        <div class="col-lg-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">Category List</li>
                                <li class="breadcrumb-item active">Update Category </li>
                            </ol>    
                        </div>
                    </div>
                    <div id="modal_body_form_area">
                        <!-------->
                        <div class="row">
                            <div class="col-lg-12">
                                Category Name
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="text" class="w3-input" id="name_update" placeholder="some name hear" onkeydown="default_text_field_update()">
                            </div>
                        </div>
                        <!-------->
                        <hr>
                        <!------------------->
                        <div class="row">
                            <div class="col-lg-12">
                                Category Description 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <textarea class="w3-input" id="dis_update" placeholder="some descrption"></textarea>
                            </div>
                        </div>
                        <!---------->
                        <hr>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="checkbox" id="show_on_web_update" class="w3-check"><label>Show this record in front web</label>
                            </div>
                        </div>
                        <hr>
                        <!------------------->
                        <div id="img_remove_update">
                            <div class="row">
                                <div class="col-lg-12">
                                    Image Or Icon
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 ">
                                    <div id="targetLayer_update">

                                    </div>
                                    <input type="hidden" id="image_state_update" value="0">
                                </div>
                                <div class="col-lg-8">
                                    <div id="img_befor_update" style="display: none;" >
                                        <form id="uploadForm_update" action="main_catergory/upload_image.php" method="post">
                                            <div id="uploadFormLayer_update">
                                                <input name="userImage_update" type="file" class="inputFile w3-input w3-theme-l4" />
                                                <input type="submit" class="w3-button w3-theme-dark w3-margin-top" value="Add Image">
                                            </div>
                                        </form>
                                    </div>
                                    <div id="img_after_update" style="display: none;" >
                                        <button onclick="remove_image()" class="w3-button w3-theme-dark w3-red w3-margin">Remove Image</button>
                                        <button onclick="change_image()" class="w3-button w3-theme-dark w3-theme-dark w3-margin">Change Image</button>
                                    </div>
                                    <div class="w3-text-red">
                                        <strong id="error_id_update">

                                        </strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---------->

                    <!---------->
                </div>
            </div>
            <div class="modal-footer" id="modal_footer">
                <button class="w3-button w3-theme-dark w3-round" id="update_data">Update Data</button>
            </div>
        </div>
    </div>
</div>