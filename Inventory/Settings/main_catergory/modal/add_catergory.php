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
                    alert(data)
//                    $("#targetLayer").html(data);
                    after_upload();

                },
                error: function ()
                {
                }
            });
        }));
    });

    function add_new() {
        set_up_modal();
        $("#myModal").modal('show');
    }

    function set_up_modal() {
        document.getElementById("uploadForm").reset();
        var add_btn = document.getElementById("add_btn");
        add_btn.style.display = "block";
        
        var change_btn = document.getElementById("change_btn");
        $(change_btn).empty();

        var remove_btn = document.getElementById("remove_btn");
        $(remove_btn).empty();
        
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
        input_name.setAttribute("placeholder", "some name hear");
        input_name.value = name;

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

//        text_area.appendChild(document.createTextNode(dis));

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

//        if (show_on_web == 1) {
//            $(check_box).prop("checked", true);
//        }

        var lable_check_text = document.createElement("label");
        lable_check_text.appendChild(document.createTextNode("  Show this record in front web"));

        div_col_05.appendChild(check_box);
        div_col_05.appendChild(lable_check_text);
        div_row_05.appendChild(div_col_05);

        get_body.appendChild(div_row_05);

        //        ----------------------   
        get_body.appendChild(document.createElement("hr"));


    }
    function after_upload() {
        var change_btn = document.getElementById("change_btn");
        $(change_btn).empty();

        var remove_btn = document.getElementById("remove_btn");
        $(remove_btn).empty();

        var img_setup_remove = document.createElement("button");
        img_setup_remove.setAttribute("class", "w3-button w3-theme-dark w3-red w3-margin w3-input");
        img_setup_remove.appendChild(document.createTextNode("Remove Image"));
        img_setup_remove.addEventListener("click", function () {
            alert('test');

        });
        remove_btn.appendChild(img_setup_remove);


        var img_setup_change = document.createElement("button");
        img_setup_change.setAttribute("class", "w3-button w3-theme-dark w3-margin w3-input");
        img_setup_change.appendChild(document.createTextNode("Change Image"));
        img_setup_change.addEventListener("click", function () {
            alert('test');
        });

        change_btn.appendChild(img_setup_change);

        var add_btn = document.getElementById("add_btn");
        add_btn.style.display = "none";
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
                            <div class="col-lg-6"></div>
                            <div class="col-lg-6">
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
                                                    <input name="userImage" type="file" class="inputFile w3-input w3-theme-l4" />
                                                    <input type="submit" class="w3-button w3-theme-dark w3-margin-top" value="Add Image">
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