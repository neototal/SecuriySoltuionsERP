<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include_once '../../Imports/header/session_setup.php';
?>

<html>
    <head>
        <meta charset="UTF-8">

    </head>
    <body>
        dir block page
        <?php
        unset($_SESSION['user_id']);

        if (!isset($_SESSION['dir_block_01'])) {
            $_SESSION['dir_block_01'] = "ok_01";
        } else if (!isset($_SESSION['dir_block_02'])) {
            $_SESSION['dir_block_02'] = "ok_02";
        } else if (!isset($_SESSION['dir_block_03'])) {
            $_SESSION['dir_block_03'] = "ok_03";
        }
        ?>
        <?php
        if (isset($_SESSION['dir_block_03'])) {
            ?>
            <script type="text/javascript">
                window.location.replace("<?php echo $pth; ?>Imports/admin_roll_settings/system_lock.php");
            </script>
            <?php
        }
        ?>
    </body>
</html>
