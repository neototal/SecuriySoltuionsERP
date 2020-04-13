<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript">
            function test() {
                $.post("back_eand.php",
                        {
                            name: "Donald Duck",
                            city: "Duckburg",
                            app: "test"
                        },
                function (data, status) {
                    alert(data);
                    alert(status);
                });
            }
            function test2() {
                $.get("back_eand.php?test=123", function (data, status) {
                    alert(data);
                });
            }
        </script>
    </head>
    <body>
        <button onclick="test()">test</button>
        <button onclick="test2()">test2</button>
    </body>
</html>
