<style type="text/css">
    div{
        /*border: 1px black solid;*/
    }

    #sub_dis {
        text-align: justify;
        text-justify: inter-word;
    }

</style>

<script type="text/javascript">
    function setup_button(array_button_list) {
        var array_button_list_return = new Array();
        var button_header = document.getElementById("button_header");
        $(button_header).empty();

        var i = 0;
        for (i = 0; i < array_button_list.length; i++) {

            var div_row_01 = document.createElement("div");
            div_row_01.setAttribute("class", "row");

            var div_col_01 = document.createElement("div");
            div_col_01.setAttribute("class", "col-lg-12");

            var btn = document.createElement("button");
            btn.setAttribute("class", "btn btn-default w3-theme-dark w3-input w3-margin-top w3-hover-blue-grey add_record");

            var btn_strong = document.createElement("strong");

            var btn_text = array_button_list[i];

            var btn_text_obj = document.createTextNode(btn_text);

            btn_strong.appendChild(btn_text_obj);
            btn.appendChild(btn_strong);
            div_col_01.appendChild(btn);
            div_row_01.appendChild(div_col_01);

            button_header.appendChild(div_row_01);

            array_button_list_return.push(btn);
        }
        return array_button_list_return;
    }

    function load_main_body_data(id, img_url, sub_cat_name, sub_head, dis, man_cat_name, show_web_state) {
        var seup_img = document.getElementById("sub_main_img");
        if (img_url != "") {
            seup_img.setAttribute("src", "<?php echo $pth; ?>" + img_url);
        }

        var sub_heading = document.getElementById("sub_heading");
        $(sub_heading).empty();
        sub_heading.appendChild(document.createTextNode(sub_head));

        var set_sub_cat_name = document.getElementById("sub_cat_name");
        $(set_sub_cat_name).empty();
        set_sub_cat_name.appendChild(document.createTextNode(sub_cat_name));

        var set_dis = document.getElementById("sub_dis");
        $(set_dis).empty();
        set_dis.appendChild(document.createTextNode(dis));

        var set_main_cat = document.getElementById("main_cat_name");
        $(set_main_cat).empty();
        if (man_cat_name != "") {
            set_main_cat.appendChild(document.createTextNode("by main category : " + man_cat_name));
        }

        if (show_web_state == 1) {
            $("#show_on_web").prop("checked", true);
        }
    }
</script>   

<div class="row jumbotron w3-theme-l4">
    <div class="col-lg-3 col-sm-3">
        <img src="<?php echo $pth;?>Imports/img/Settings/not_found.png" id="sub_main_img" class="w3-round" style="width: 250px;">
    </div>
    <div class="col-lg-9 col-sm-9">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 w3-border-black w3-border-bottom w3-margin-bottom">
                    <h2 id="sub_cat_name"></h2>
<!--                    <p id="sub_heading"></p>-->
                    <span id="sub_heading"></span>
                </div>
                <div class="col-lg-6">
                    <div class="input-group">
                        <input type="text" class="form-control" id="search_value"  autocomplete="off" placeholder="search">
                        <span class="input-group-btn">
                            <button class="btn btn-default" id="search_value_btn"><span class="fa fa-search"></span></button>
                        </span>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8" id="sub_dis">
                   
                </div>
                <div class="col-lg-4">
                    <div class="container-fluid" id="button_header">

                    </div>

                </div>
            </div>
            <!------>

            <div class="row">
                <div class="col-lg-12">
                    <input class="w3-check" id="show_on_web" type="checkbox">
                    <label>View On Main Web </label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 w3-text-grey" id="main_cat_name">
                   
                </div>
            </div>
        </div>
    </div>
</div>