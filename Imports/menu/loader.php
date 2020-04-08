<script type="text/javascript">
    $(document).ready(function () {
        $(document).ajaxStart(function () {
//            alert('start');
            $("#myModal_loder").modal('show');
        });
        $(document).ajaxComplete(function () {
//            alert('end');
//            await sleep(20);
            $("#myModal_loder").modal('hide');
        });
    });
</script>

<div class="modal modal-static" id="myModal_loder" role="dialog" aria-hidden="false">
    <div class="modal-dialog" id="modal-dialog">
        <div class="modal-content" id="modal-content">
            <div class="modal-body" style="background-color:transparent;">
                <div class="text-center">
                    <center>
                        <div class="clearfix" style="margin-bottom: 20%;"></div>

                        <img class= "w3-image w3-circle img-responsive" src="<?php echo $pth; ?>Imports/img/Settings/robot-change-head.gif"  id="placewait"/>  
                        <h2>Please Wait..</h2>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
    #modal-dialog {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        /*background-color:transparent;*/
    }

    #modal-content {
        height: auto;
        min-height: 100%;
        border-radius: 0;
        background-color:transparent;
    }
    #placewait {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border: 1px black;
    }
</style>

