


<script type="text/javascript">
    
    function reset_add_data_modal(){
        $("#name").val('');
        $("#dis").val('');
        $("#show_on_web_sub").prop("checked",false);
    }
    
    function add_sub_data() {
        
        var error_id = document.getElementById("error_id");
        $(error_id).empty();
        if ($("#name").val() == "") {
            var name = document.getElementById("name");
            name.setAttribute("class", "w3-input w3-border w3-border-grey w3-red");
            error_id.appendChild(document.createTextNode("name field is empty"));

        } else {

            var value_of_showing_web = 0;
            if (document.getElementById("show_on_web_sub").checked) {
                value_of_showing_web = 1;
//                alert('test');
            }
            var sending_value = "name=" + $("#name").val() + "&dis=" + $("#dis").val() + "&show_on_web=" + value_of_showing_web + "&main_name=" + document.getElementById("sub_main_cat_name").innerHTML;
//            alert(sending_value);

            $.ajax({
                url: "sub_category/add_data.php",
                type: 'POST',
                data: sending_value,
                cache: false,
                success: function (data) {
                    if(data==1){
                        $("#myModal").modal('hide');
//                        alert('test');
                    }else{
                        error_id.appendChild(data);
                    }
                }
            });



            load_data();
        }
    }
    function add_sub_error() {
        var name = document.getElementById("name");
        name.setAttribute("class", "w3-input w3-border w3-border-grey");
        var error_id = document.getElementById("error_id");
        $(error_id).empty();
    }

</script>
<!-- Modal -->

<div class="modal fade w3-white w3-opacity w3-right" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content w3-theme-l4">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal_head">
                    Create New Sub Category 	
                </h4>
            </div>
            <div class="modal-body" id="modal_body">
                <div class="container-fluid">
                    <div class="row">
                        <ul class="breadcrumb">
                            <!--<li class="breadcrumb-item">Category List</li>-->
                            <li class="breadcrumb-item">Sub Category List</li>
                            <li class="breadcrumb-item active">Create New Sub Category</li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <lable>Sub Category Name</lable>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="text" id="name" onkeydown="add_sub_error()" autocomplete="off" class="w3-input w3-border w3-border-grey" placeholder="some name hear">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <lable>Description</lable>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <textarea id="dis" class="w3-input w3-border w3-border-grey" placeholder="Note :"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-lg-12">
                            <input type="checkbox"  id="show_on_web_sub" class="w3-check"> <label>Show this record in front web</label>
                        </div>
                    </div>
                    <div class="row">
                        <strong>
                            <div class="col-lg-12 w3-center w3-text-red" id="error_id">
                                test test
                            </div>
                        </strong>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="modal_footer">
                <button class="w3-button w3-theme-dark" onclick="add_sub_data()">Add New Category</button>
            </div>
        </div>
    </div>
</div>