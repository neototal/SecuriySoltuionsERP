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

</script>
<!-- Modal -->

<div class="modal fade w3-white w3-opacity w3-right" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content w3-theme-l4">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
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

                    </div>
                    <!--//        ------------------------------------------------------------------------------------------------------------------>
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


                </div>
            </div>
            <div class="modal-footer" id="modal_footer">

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function add_modal() {
        procee_modal("", "", "", "asdfa", "", "", false);

    }
    function procee_modal(id, name, dis, img_pth, since_date, show_on_web_state, update_state) {
        var modal_head = document.getElementById("modal_head");
        $(modal_head).empty();
//        ----------------------------------------------------------------------------------------------------------------

        var heading_text = "Register New Brand To " + document.getElementById("sub_cat_name").innerHTML;
        if (update_state) {
            heading_text = "update " + name;
        }
        modal_head.appendChild(document.createTextNode(heading_text));
//        ----------------------------------------------------------------------------------------------------------------
        document.getElementById("set_breadcrum_modal").innerHTML = document.getElementById("set_breadcrum").innerHTML;
//        ----------------------------------------------------------------------------------------------------------------
        var set_breadcrum_modal_current = document.getElementById("set_breadcrum_modal_current");
        var set_breadcrum_modal_current_text = "Add new record";
        if (update_state) {
            set_breadcrum_modal_current_text = "update " + name;
        }
        set_breadcrum_modal_current.appendChild(document.createTextNode(set_breadcrum_modal_current_text))
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
        div_col_01.appendChild(name_text);

        div_row_01.appendChild(div_col_01);


        var div_row_02 = document.createElement("div");
        div_row_02.setAttribute("class", "row");
        var div_col_02 = document.createElement("div");
        div_col_02.setAttribute("class", "col-lg-12");

        var lable_02 = document.createElement("lable");
        lable_02.appendChild(document.createTextNode("Description"));
        div_col_02.appendChild(lable_02);

        var text_area = document.createElement("textarea");
        text_area.setAttribute("class", "w3-input w3-border w3-border-black");
        text_area.setAttribute("placeholder", "Note :");
        text_area.style.height = "100px";

        if (update_state) {
            text_area.appendChild(document.createTextNode(dis));
        }
        div_col_02.appendChild(text_area);


        div_row_02.appendChild(div_col_02);

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
        modal_body_from.appendChild(document.createElement("hr"));
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



        var button_update = document.createElement("button");
        button_update.setAttribute("class", "w3-button w3-theme-dark w3-hover-blue-grey w3-round");
        button_update.appendChild(document.createTextNode("Update " + name));


        if (update_state) {
            footer_body.appendChild(button_update);
        } else {
            footer_body.appendChild(button_add);
        }

//        ----------------------------------------------------------------
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


        var btn_remove = document.createElement("button");
        btn_remove.setAttribute("class", "w3-button w3-theme-dark w3-red w3-margin w3-input");
        btn_remove.appendChild(document.createTextNode("Remove Image"));


//        ---------------------------------------------------------------------


        if (img_pth == "") {
            image_body.appendChild(document.createTextNode("No Image"));
            upload_body.style.display = "block";
        } else {
            upload_body.style.display = "none";
            
            var img=document.createElement("img");
            img.setAttribute("src",<?php echo $pth;?>img_pth);
            image_body.appendChild(img);
            change_btn.appendChild(btn_chage);
            remove_btn.appendChild(btn_remove);

        }
    }


    function close_modal() {
        $("#myModal").modal('hide');
    }
</script>