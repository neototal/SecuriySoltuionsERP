<div style="height: 100px;"></div>

<div class="container-fluid w3-theme-dark w3-margin-top w3-bottom" id="footer_body">
    <div class="row">
        <div class="col-lg-12 w3-padding">
            &copy; <?php echo date("Y"); ?> - Neo Total Security Solutions (Pvt) Ltd 
        </div>
    </div>
</div>
<script type="text/javascript">

    function setup_footer() {
        var ifooter = document.getElementById("footer_body");
        if (document.body.scrollHeight > window.innerHeight) {
            ifooter.setAttribute("class", "container-fluid w3-theme-dark w3-margin-top");
        } else {
            ifooter.setAttribute("class", "container-fluid w3-theme-dark w3-margin-top w3-bottom");
        }
    }
</script>
