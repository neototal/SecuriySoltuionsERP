<?php
//listing_record
//update_record
//delete_record
//add_record
get_page_id(isset($_SESSION['page_id']) ? $_SESSION['page_id'] : "");

function get_page_id($get_page_id) {
    
}
?>

<script type="text/javascript">
    $(document).ready(function () {
//        roll_management();
    });


    function roll_management() {
        var roll = document.getElementsByClassName("add_record");
        for (var i = 0; i < roll.length; i++) {
            roll[i].disabled = true;
        }
    }

</script>
