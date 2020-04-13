<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
include_once $pth . 'Imports/DB/Database_conn.php';

$userid = isset($_SESSION['userid']) ? $userid = $_SESSION['userid'] : "Not Found";
$empid = isset($_SESSION['empid']) ? $userid = $_SESSION['userid'] : "Not Found";

$emp_name = "Not Found";
$emp_img_url = "";
$con = database();
$sql = "select * from employee_info where idemployee_info='" . $empid . "'";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    if ($row = $result->fetch_assoc()) {
        $emp_name = $row['name'];
        $emp_img_url = (isset($_SESSION['pth']) ? $pth = $_SESSION['pth'] : "") . $row['img'];
    }
} else {
    error();
}

function error() {

    $pth = isset($_SESSION['pth']) ? $pth = $_SESSION['pth'] : "";
//    header('Location: ' . $pth . 'index.php?error=Session has expiry login to system');
//    
//
    ?>
    <script type="text/javascript">
        window.location.replace("<?php echo $pth; ?>index.php?error=Session has expiry login to system");
    </script>
    <?php
}
?>
<style type="text/css">
    div{
        /*border: 1px black solid;*/
    }
    .image-preview {	
        width:150px;
        height:150px;
        border-bottom-left-radius: 4px;
        border-top-left-radius: 4px;
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
<script type="text/javascript">
    function logout() {
        if (confirm('Do you want to logout form system')) {
            window.location.href = "<?php echo $pth; ?>Login/Logout.php"
        }

    }

</script>
<div class="w3-bar w3-theme-dark container w3-margin-right w3-mobile">
    <button onclick="logout()" class="w3-bar-item w3-theme-dark w3-right w3-hover-blue-grey">  <i class="fa fa-sign-out w3-padding " style="font-size:20px"></i></button>

    <div class="w3-dropdown-hover w3-right">
        <button class="w3-theme-dark w3-button w3-hover-blue-grey"> <img src="<?php echo $emp_img_url; ?>" class="w3-circle " style="width: 40px;"></button>
        <div class="w3-dropdown-content w3-card-2 w3-theme-d3 w3-bar-block w3-top">
            <ul class="w3-ul w3-hover-shadow w3-round" style="width: 190px;">
                <li class="w3-padding-16 w3-theme-dark w3-center w3-large">Account Settings</li>
                <li class="w3-padding w3-hover-grey">Profile</li>
                <li class="w3-padding w3-hover-grey">User Account</li>
            </ul>
        </div>
    </div>



    <div class="w3-dropdown-hover w3-right">
        <button class="w3-theme-dark  w3-hover-blue-grey w3-button"> <i class="fa fa-envelope w3-padding  " style="font-size:20px"></i></button>
        <div class="w3-dropdown-content w3-top w3-card-2 w3-theme-d3 w3-round" style="width: 150px;">
            <ul class="w3-hover-shadow w3-ul w3-round">
                <li class="w3-large w3-theme-dark w3-padding-16 w3-center">Mail</li>
                <li class="w3-padding w3-hover-grey">New Mail</li>
                <li class="w3-padding w3-hover-grey">Inbox</li>
                <li class="w3-padding w3-hover-grey">Sent Mail</li>
            </ul>
        </div>
    </div>

    <div class="w3-dropdown-hover w3-right">
        <button class="w3-button w3-theme-dark w3-hover-blue-grey">  <i class="fa fa-bell w3-padding  " style="font-size:20px"></i></button>
        <div class="w3-dropdown-content w3-card-4 w3-theme-d3 w3-round w3-top" style="width: 250px;">
            <ul class="w3-ul w3-hover-shadow w3-round">
                <li class="w3-theme-dark w3-large w3-padding-16 w3-center">Notification</li>
                <!--<li class="w3-padding">Not Found</li>-->
                <li class="w3-padding w3-opacity w3-hover-grey">Not Found</li>

            </ul>
        </div>
    </div>
</div>