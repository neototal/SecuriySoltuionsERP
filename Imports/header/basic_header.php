
<?php
$pth = "";

//title setup from session
isset($_SESSION['title']) ? '' : $_SESSION['title'] = "Home";
//lib imports session 
isset($_SESSION['pth']) ? $pth = $_SESSION['pth'] : $pth = "";
?>

<title>Neo Total Security Solutions | <?php echo $_SESSION['title']; ?> </title>

<style type="text/css">
    div{
        /*border: 1px black solid;*/
    }
    #targetLayer{
        float:left;
        width:150px;
        height:150px;
        text-align:center;
        line-height:150px;
        font-weight: bold;
        color: #C0C0C0;
        background-color: #F0E8E0;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
    }
</style>
<!--w3css color theam-->
<link rel="stylesheet" href="<?php echo $pth; ?>Imports/lib/w3css_color.css">
<?php
include_once $pth . 'Imports/lib/css_online_imports.php';
include_once $pth . 'Imports/lib/js_online_improrts.php';
?>

<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
--><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<meta charset="UTF-8">
<noscript>
<meta http-equiv="refresh" content="0;url=<?php echo $pth; ?>Imports/admin_roll_settings/js_disable.php">
</noscript>
<style type="text/css">
    #myModal,.modal{
        background-image: url('<?php echo $pth; ?>Imports/img/finalLogo.png');background-repeat: no-repeat;background-position:  bottom right;background-size: 20%;
    }
</style>


<script type="text/javascript">
    $(document).ready(function () {
//        alert('test');
        var get_browser_height = window.innerHeight * 70 / 100;
//        alert(get_browser_height);
        var modal_body = document.getElementById("modal_body");
        var modal_body_height = modal_body.offsetHeight;
        modal_body.style.maxHeight = get_browser_height + "px";
        modal_body.style.overflowX = "hidden";
        if (modal_body_height > get_browser_height) {
            modal_body.style.overflowY = "scroll";
        }

    });
</script>