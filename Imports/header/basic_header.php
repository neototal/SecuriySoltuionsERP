
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
</style>
<!--w3css color theam-->
<link rel="stylesheet" href="<?php echo $pth; ?>Imports/lib/w3css_color.css">
<?php
include_once $pth . 'Imports/lib/css_online_imports.php';
include_once $pth . 'Imports/lib/js_online_improrts.php';
?>
<link rel="stylesheet" href="<?php echo $pth; ?>Imports/lib/css/upload_process.css">
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
    [type="date"] {
        background:#fff url(https://cdn1.iconfinder.com/data/icons/cc_mono_icon_set/blacks/16x16/calendar_2.png)  97% 50% no-repeat ;
    }
    [type="date"]::-webkit-inner-spin-button {
        display: none;
    }
    [type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
    }

    /* custom styles */
   
    input,textArea {
        border: 1px solid #c4c4c4;
        border-radius: 5px;
        background-color: #fff;
        padding: 3px 5px;
        box-shadow: inset 0 3px 6px rgba(0,0,0,0.1);
  
    }
</style>