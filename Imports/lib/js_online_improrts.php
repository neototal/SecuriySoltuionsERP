<?php
$pth = "";
isset($_SESSION['pth']) ? $pth = $_SESSION['pth'] : $pth = "";
?>


<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>-->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" ></script>
<script src="<?php echo $pth;?>Imports/lib/js/bootstrap.js"></script>
<script src="<?php echo $pth;?>Imports/lib/js/backDisable.js"></script>
<script src="<?php echo $pth;?>Imports/lib/js/noframework.waypoints.min.js"></script>
<script src="<?php echo $pth;?>Imports/lib/js/jquery.cookie.js"></script>