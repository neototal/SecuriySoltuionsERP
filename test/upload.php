<html>
    <script src="../Imports/lib/js/dropzone.js"></script>
    <script src="../Imports/lib/js/dropzone-amd-module.js"></script>
    <link rel="stylesheet" href="../Imports/lib/css/dropzone.css">
    <?php
    include '../Imports/lib/js_online_improrts.php';
    include '../Imports/lib/css_online_imports.php';
    ?>

    <body>

        <!--        <form action="./fileUpload.php" method="POST" class="dropzone" enctype="multipart/form-data">
                    <input type="file" name="file" />
                    <input type="submit"/>
                </form>-->
        <form action="./fileUpload.php" class="dropzone" id="upload-widget">
            <div class="fallback" >
                <input name="file" type="file" accept="image/*" />
            </div>
        </form>
        <!--<form action="fileUpload.php" class="dropzone"></form>-->
        <!--        <form action="./fileUpload.php" method="post" enctype="multipart/form-data">
                    <input type="file" name="file" />
                </form>-->
    </body>
</html>
