<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<html>
    <head>
        <meta charset="UTF-8">
        <?php
        include_once '../Imports/header/session_setup.php';
        $_SESSION['pth'] = "../";
        $_SESSION['title'] = "Home";
        include_once '../Imports/header/basic_header.php';
        ?>
    </head>
    <body class="w3-theme-l5">
        <?php
        include_once '../Imports/menu/main_menue.php';
        ?>
        
        <a href="../Inventory/Settings/Main_category.php">main category</a>
        <?php
        include_once '../Imports/footer/footer_system.php';
        ?>
    </body>
</html>
